<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MessageTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('messages')->insert([
            'sender_id' => '1',
            'receiver_id' => '2',
            'message' => 'How are you?',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('messages')->insert([
            'sender_id' => '2',
            'receiver_id' => '1',
            'message' => 'Im okay thanks, how are you?',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('messages')->insert([
            'sender_id' => '1',
            'receiver_id' => '2',
            'message' => 'Good thanks, would you accept £10 for the chair?',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('messages')->insert([
            'sender_id' => '2',
            'receiver_id' => '1',
            'message' => 'Probably not, maybe £15 though',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('messages')->insert([
            'sender_id' => '3',
            'receiver_id' => '2',
            'message' => 'Hey',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('messages')->insert([
            'sender_id' => '2',
            'receiver_id' => '3',
            'message' => 'Hi!',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('messages')->insert([
            'sender_id' => '3',
            'receiver_id' => '2',
            'message' => 'Do you want a puppy?',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('messages')->insert([
            'sender_id' => '2',
            'receiver_id' => '3',
            'message' => 'Yes please!',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
