<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Funcion para almacenar los mensajes enviados en el foro de discusion
     * @param Request $request 
     * @return type
     */
    public function store(Request $request)
    {
    	$this->validate($request, Message::$rules, Message::$messages);

    	$message = new Message();
    	$message->incident_id = $request->input('incident_id');
    	$message->message = $request->input('message');
    	$message->user_id = auth()->user()->id;
    	$message->save();

    	return back()->with('notification', 'Su mensaje se ha enviado con éxito.');
    }

}
