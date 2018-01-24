<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            'item_id' => 4,
            'path' => 'item/4/oTyaJpdMawgKZzBRfNywhlp8Z0dixemvCKgnCAlw.jpeg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('images')->insert([
            'item_id' => 4,
            'path' => 'item/4/yRq0tfn1Njj6i5vXjr3C2cnHixn9swycsmxEVuH3.jpeg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('images')->insert([
            'item_id' => 4,
            'path' => 'item/4/dqYBsaj93h5uOl4BiOPdLTdr8cHqnq4fQJFp4wmg.jpeg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}