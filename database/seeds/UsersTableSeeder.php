<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        User::create([
        	'name' => 'Christian',
        	'email' => 'admin@hotmail.com',
            'password' => bcrypt('19972000'),
            'avatar' => 'https://www.sogapar.info/wp-content/uploads/2015/12/default-user-image.png',
        	'profile_id' => 1
        ]);
        
        
        //Client 1
                 
        
    }
}
