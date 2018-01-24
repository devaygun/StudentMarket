<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
//        GENERATE ALL MESSAGES FROM OR TO THE LOGGED IN USER
        $messages = Message::where('sender_id', User::find(Auth::id())->id)
            ->orWhere('receiver_id', User::find(Auth::id())->id)
            ->orderBy('created_at')
            ->get();

//        GENERATE LIST OF MESSAGED USERS
        $userList = Message::select('sender_id')
            ->where('receiver_id', User::find(Auth::id())->id)
            ->distinct()
            ->orderBy('created_at')
            ->get();

        $userList2 = Message::select('receiver_id')
            ->where('sender_id', User::find(Auth::id())->id)
            ->distinct()
            ->orderBy('created_at')
            ->get();

        foreach ($userList2 as $u) {
            if (!$userList->contains('sender_id', $u->receiver_id)) {
                $userList->push($u);
            }
        }

        return view('messages.index', ['messages' => $messages, 'userList' => $userList]);
    }

    public function viewMessages($id = null)
    {
//        IF USER TRIES TO MESSAGE THEMSELVES, REDIRECT
        if ($id == User::find(Auth::id())->id) {
            return redirect()->action('MessageController@index');
        }

        // SELECT ALL MESSAGES FROM OR TO USER
        $messages = Message::where('sender_id', User::find(Auth::id())->id)->Where('receiver_id', $id)
            ->orWhere('sender_id', $id)->Where('receiver_id', User::find(Auth::id())->id)
            ->orderBy('created_at')
            ->get();

        //        GENERATE LIST OF MESSAGED USERS
        $userList = Message::select('sender_id')
            ->where('receiver_id', User::find(Auth::id())->id)
            ->distinct()
            ->orderBy('created_at')
            ->get();

        $userList2 = Message::select('receiver_id')
            ->where('sender_id', User::find(Auth::id())->id)
            ->distinct()
            ->orderBy('created_at')
            ->get();

        foreach ($userList2 as $u) {
            if (!$userList->contains('sender_id', $u->receiver_id)) {
                $userList->push($u);
                dump('working');
            }
        }

        return view('messages.read', ['messages' => $messages, 'recipient' => $id, 'userList' => $userList]);
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
