<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'comment' => 'I love this book. Do you only have the one copy for sale?',
            'reply_id' => 0,
            'item_id' => 3,
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('comments')->insert([
            'comment' => 'Yes, unfortunately there is only one copy for sale',
            'reply_id' => 1,
            'item_id' => 3,
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('comments')->insert([
            'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum a pretium sem. Duis rhoncus lectus non tellus scelerisque semper facilisis a est. Praesent sed mi eu 
            mauris egestas pretium vel et justo. Donec non velit orci. Quisque egestas sapien vel erat auctor interdum. Donec libero enim, vulputate et tristique eget, blandit
             sit amet nulla. Quisque vel tincidunt eros. Nunc mauris ex, lobortis aliquet tincidunt tempus, ornare viverra lorem.',
            'reply_id' => 2,
            'item_id' => 3,
            'user_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
