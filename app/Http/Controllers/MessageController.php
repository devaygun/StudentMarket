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
        $messages = Message::all()->where('receiver_id', User::find(Auth::id())->id);
//        $messages = Message::where('receiver_id', User::find(Auth::id())->id)->groupBy('receiver_id')->get();

//        $messages = Message::where('sender_id', User::find(Auth::id())->id)
//            ->orWhere('receiver_id', User::find(Auth::id())->id)
//            ->orderBy('created_at')
//            ->get();
//        $messages = $messages->groupBy('sender_id')->get();

        return view('messages.index', ['messages' => $messages]);
    }

    public function viewMessages($id = null)
    {
        if ($id == User::find(Auth::id())->id) {
            return redirect()->action('MessageController@index');
        }

        // SELECT ALL MESSAGES FROM OR TO USER
        $messages = Message::where('sender_id', User::find(Auth::id())->id)->Where('receiver_id', $id)
            ->orWhere('sender_id', $id)->Where('receiver_id', User::find(Auth::id())->id)
            ->orderBy('created_at')
            ->get();


        return view('messages.read', ['messages' => $messages, 'recipient' => $id]);
    }

    public function sendMessage($id = null, Request $request)
    {
        if ($id == User::find(Auth::id())->id) {
            return redirect()->action('MessageController@index');
        }

        $user = User::find(Auth::id());
        $recip = User::find($id); // FIND SEARCHED USER

        $request->validate([
//            'seller_id' => 'required|exists:users,id',
//            'buyer_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000'
        ]);

        $message = new Message();
        $message->sender_id = User::find(Auth::id())->id;
        $message->receiver_id = User::find($id)->id;
        $message->message = $request->message;
        $message->save();

        return redirect()->action('MessageController@viewMessages', ['id' => $id]);
    }
}
