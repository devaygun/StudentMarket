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
            'type' => 'sell',
            'price' => 45,
            'trade' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('items')->insert([
            'user_id' => 1,
            'category_id' => 1,
            'name' => 'Russel Hobbs Kettle',
            'description' => 'Great valued kettle.',
            'type' => 'sell',
            'price' => 4,
            'trade' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('items')->insert([
            'user_id' => 1,
            'category_id' => 3,
            'name' => 'Getting Things Done - David Allen',
            'description' => "Discover David Allen's powerful methods for stress-free performance at work and in life.",
            'type' => 'sell',
            'price' => 7,
            'trade' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('items')->insert([
            'user_id' => 2,
            'category_id' => 2,
            'name' => 'Sony Speakers',
            'description' => "Best speakers in the world",
            'type' => 'swap',
            'price' => null,
            'trade' => "Puppy",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('items')->insert([
            'user_id' => 3,
            'category_id' => 3,
            'name' => 'Book',
            'description' => "An old book",
            'type' => 'sell',
            'price' => 5,
            'trade' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('items')->insert([
            'user_id' => 2,
            'category_id' => 3,
            'name' => 'Apollo Bike',
            'description' => "Fairly new apollo bike. Ridden a few times, looks brand new.",
            'type' => 'part-exchange',
            'price' => 40,
            'trade' => 'Skateboard',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
