<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\User;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::find(Auth::id());

        $messages = Message::where('sender_id', User::find(Auth::id())->id)
            ->orWhere('receiver_id', User::find(Auth::id())->id)
            ->get();

        dump($messages);
        return view('messages.index', ['messages' => $messages]);
    }
}
