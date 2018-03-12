<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\User;

/**
 * @resource Messages
 */
class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Provides a response to API requests in JSON with a consistent formatting
     */
    public function apiResponse($success, $message, $data, $status = 200) {
        return response()->json(['success' => $success, 'message' => $message, 'data' => $data], $status);
    }

    /**
     * Messages
     *
     * Displays users and messages for the authenticated user
     */
    public function index(Request $request) {
        $auth_id = $request->is('api/*') ? User::where('api_token', $request->api_token)->first()->id : Auth::id(); // Retrieve the user's ID based on if the request is from the API or not

        // GENERATE ALL MESSAGES FROM OR TO THE LOGGED IN USER
        $messages = Message::where('sender_id', $auth_id)
            ->orWhere('receiver_id', $auth_id)
            ->orderBy('created_at')
            ->get();

        // GENERATE LIST OF MESSAGED USERS
        $userList = Message::select('sender_id', 'users.*')
            ->where('receiver_id', $auth_id)
            ->distinct()
            ->orderBy('messages.created_at')
            ->leftJoin('users', 'users.id', '=', 'sender_id')
            ->get();

        $userList2 = Message::select('receiver_id')
            ->where('sender_id', $auth_id)
            ->distinct()
            ->orderBy('created_at')
            ->get();

        foreach ($userList2 as $u)
            if (!$userList->contains('sender_id', $u->receiver_id))
                $userList->push($u);

        $data = ['messages' => $messages, 'userList' => $userList];

        if ($request->is('api/*'))
            return $this->apiResponse(true, 'Successfully retrieved messages index', $data);

        return view('messages.index', $data);
    }

    /**
     * View Message
     *
     * Returns all messages from a specific conversation
     */
    public function viewMessages(Request $request, $id = null)
    {
        $auth_id = $request->is('api/*') ? User::where('api_token', $request->api_token)->first()->id : Auth::id(); // Retrieve the user's ID based on if the request is from the API or not

        // IF USER TRIES TO MESSAGE THEMSELVES, REDIRECT
        if ($id == $auth_id)
            return redirect()->action('MessageController@index');

        // SELECT ALL MESSAGES FROM OR TO USER
        $messages = Message::where('sender_id', $auth_id)->Where('receiver_id', $id)
            ->orWhere('sender_id', $id)->Where('receiver_id', $auth_id)
            ->orderBy('created_at')
            ->get();

        //        GENERATE LIST OF MESSAGED USERS
        $userList = Message::select('sender_id')
            ->where('receiver_id', $auth_id)
            ->distinct()
            ->orderBy('created_at')
            ->get();

        $userList2 = Message::select('receiver_id')
            ->where('sender_id', $auth_id)
            ->distinct()
            ->orderBy('created_at')
            ->get();

        foreach ($userList2 as $u)
            if (!$userList->contains('sender_id', $u->receiver_id))
                $userList->push($u);

        $data = ['messages' => $messages, 'recipient' => $id, 'userList' => $userList];

        if ($request->is('api/*'))
            return $this->apiResponse(true, 'Successfully read messages', $data);

        return view('messages.read', $data);
    }

    /**
     * Send Message
     *
     * Sends a message from the sender to the receiver
     */
    public function sendMessage(Request $request, $id = null)
    {
        $auth_id = $request->is('api/*') ? User::where('api_token', $request->api_token)->first()->id : Auth::id(); // Retrieve the user's ID based on if the request is from the API or not

        if ($id == $auth_id)
            return redirect()->action('MessageController@index');

        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $message = new Message();
        $message->sender_id = $auth_id;
        $message->receiver_id = User::find($id)->id;
        $message->message = $request->message;
        $message->save();

        if ($request->is('api/*'))
            return $this->apiResponse(true, 'Successfully sent message', ['id' => $id]);

        return redirect()->action('MessageController@viewMessages', ['id' => $id]);
    }
}
