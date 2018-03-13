<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        //$request->validate([
        //'comment' => 'required','string',
        // 'reply_id' => 'filled',
        // 'item_id' => 'filled',
        // 'user_id' => 'required',
        //]);

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->item_id = $request->item_id;
        $comment->reply_id = 0;
        $comment->save();

        return redirect()->back();
    }

    public function index($itemId)
    {
        $comments = Comment::where('item_id', $itemId)->get();
        $commentsData = [];
        foreach ($comments as $key) {
            $user = $key->user_id;
            $name = $user->first_name;
            $replies = $this->replies($key->id);
            $image = $key->user->getProfilePicture();
            $reply = 0;
            array_push($commentsData, [
                "name" => $name,
                "image" => $image,
                "comment_id" => $key->id,
                "comment" => $key->comment,
                "reply" => $reply,
                "replies" => $replies,
                "date" => $key->created_at->toDateTimeString()
            ]);
        }
        $collection = collect($commentsData);
        return $collection->sortBy('date');
    }

    protected function replies($commentId)
    {
        $comments = Comment::where('reply_id', $commentId)->get();
        $replies = [];
        foreach ($comments as $key) {
            $user = $key->user_id;
            $name = $user->first_name;
            $image = $key->user->getProfilePicture();
            array_push($replies, [
                "name" => $name,
                "image" => $image,
                "comment_id" => $key->id,
                "comment" => $key->comment,
                "date" => $key->created_at->toDateTimeString()
            ]);
        }
        $collection = collect($replies);
        return $collection->sortBy('date');
    }

    public function deleteComment($id)
    {
        $comment = Comment::find($id);

        $authorised = ($comment->user_id == Auth::id()) ? true : false; // Checks to see if the comment belongs to the authenticated user

        // only delete if user is authorised
        if ($authorised) {
            $comment->delete();
        }
        return redirect()->back();
    }
}