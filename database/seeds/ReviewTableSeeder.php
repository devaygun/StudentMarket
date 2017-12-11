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
        DB::table('reviews')->insert([
            'seller_id' => 1,
            'buyer_id' => 2,
            'review' => 'Great seller! Transaction was very simple!',
            'rating' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('reviews')->insert([
            'seller_id' => 1,
            'buyer_id' => 3,
            'review' => 'Transaction was easy, good sell.',
            'rating' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}