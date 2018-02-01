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
        DB::table('messages')->insert([
            'comment' => 'Is shipping included @DenizAygun?',
            'reply_id' => null,
            'item_id' => 4,
            'user_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
