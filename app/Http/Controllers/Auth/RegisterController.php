<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\SocialProvider;
use Socialite;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => $data['avatar'],
        ]);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            
            $socialUser = Socialite::driver($provider)->user();
            $imagen = $socialUser->getAvatar();
           // dd($imagen);

        } catch (Exception $e) {
            return redirect('/');
        }
        
        //check if we have logged provider
        $socialProvider = SocialProvider::Where('provider_id', $socialUser->getId())->first();
        if (! $socialProvider) {

            

            //create a new user and provider
            $user = User::updateOrCreate(
                ['avatar' => $socialUser->getAvatar(), 'email' => $socialUser->getEmail()],
                ['name' => $socialUser->getName()]
            );


            $user->socialProvider()->create(
                ['provider_id' => $socialUser->getId(), 'provider' => $provider]
            );
        }else{
            $user = $socialProvider->user;
        }

        auth()->login($user);

        return redirect('/home');       

    }
}
