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
            'reply_id' => 0,
            'item_id' => 3,
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
