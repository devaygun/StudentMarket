<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)

    {

        $this->validate($request, [

            'comment' => 'required',

            'reply_id' => 'filled',

            'item_id' => 'filled',

            'users_id' => 'required',

        ]);

        $comment = Comment::create($request->all());

        if($comment)
            return [ "status" => "true","commentId" => $comment->id ];

    }

    public function index($itemId)

    {


        $comments = Comment::where('item_id',$itemId)->get();

        $commentsData = [];

       foreach ($comments as $key) {

           $user = User::find($key->users_id);

           $name = $user->first_name;

           $replies = $this->replies($key->id);

           $image = $user->profile_picture->path;

           $reply = 0;

               array_push($commentsData,[

                   "name" => $name,

                   "image" => (string)$image,

                   "commentid" => $key->id,

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

            $user = User::find($key->users_id);

            $name = $user->name;

            $image = $user->profile_picture->path;

                array_push($replies,[

                    "name" => $name,

                    "image" => $image,

                    "commentid" => $key->id,

                    "comment" => $key->comment,

                    "date" => $key->created_at->toDateTimeString()

                ]);

            }

            $collection = collect($replies);

            return $collection->sortBy('date');

        }
}
