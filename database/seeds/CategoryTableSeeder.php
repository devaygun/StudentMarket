<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(['name' => 'Appliances', 'slug' => 'appliances', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        DB::table('categories')->insert(['name' => 'Audio & Stereo', 'slug' => 'audio-and-stereo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        DB::table('categories')->insert(['name' => 'Books', 'slug' => 'books', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        DB::table('categories')->insert(['name' => 'Computers & Software', 'slug' => 'computers-and-software', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        DB::table('categories')->insert(['name' => 'Health & Beauty', 'slug' => 'health-and-beauty', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        DB::table('categories')->insert(['name' => 'Video Games & Consoles', 'slug' => 'video-games-and-consoles', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
    }
}
