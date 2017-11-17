<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'user_id' => 1,
            'category_id' => 1,
            'name' => 'Panasonic Microwave',
            'description' => 'A large modern 1250W microwave.',
            'exchange_type' => 'sell',
            'requested_price' => 45,
            'requested_item' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('items')->insert([
            'user_id' => 1,
            'category_id' => 1,
            'name' => 'Russel Hobbs Kettle',
            'description' => 'Great valued kettle.',
            'exchange_type' => 'sell',
            'requested_price' => 4,
            'requested_item' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('items')->insert([
            'user_id' => 1,
            'category_id' => 3,
            'name' => 'Getting Things Done - David Allen',
            'description' => "Discover David Allen's powerful methods for stress-free performance at work and in life.",
            'exchange_type' => 'sell',
            'requested_price' => 7,
            'requested_item' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('items')->insert([
            'user_id' => 2,
            'category_id' => 1,
            'name' => 'Sony Speakers',
            'description' => "Best speakers in the world",
            'exchange_type' => 'swap',
            'requested_price' => null,
            'requested_item' => "Puppy",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
