<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)

    {

        $this->validate($request, [
            'comment' => 'required', 'string',
            'reply_id' => 'filled',
            'item_id' => 'filled',
            'user_id' => 'required',
        ]);

        $comment = Comment::create($request->all());
        if($comment) {
            return ["status" => "true", "commentId" => $comment->id];
        }
    }
    public function index($itemId)
    {
        $comments = Comment::where('item_id',$itemId)->get();
        $commentsData = [];
       foreach ($comments as $key) {
           $user = $key->user_id;
           $name = $user->first_name;
           $replies = $this->replies($key->id);
           $image = $key->user->getProfilePicture();
           $reply = 0;
               array_push($commentsData,[
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
        $comments = Comment::where('reply_id',$commentId)->get();
        $replies = [];
        foreach ($comments as $key) {
            $user = $key->user_id;
            $name = $user->first_name;
            $image = $key->user->getProfilePicture();
                array_push($replies,[
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
}
