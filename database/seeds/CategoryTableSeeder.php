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
        DB::table('categories')->insert(['name' => 'Audio & Stereo', 'slug' => 'audio_and_stereo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        DB::table('categories')->insert(['name' => 'Books', 'slug' => 'books', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        DB::table('categories')->insert(['name' => 'Computers & Software', 'slug' => 'computers_and_software', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        DB::table('categories')->insert(['name' => 'Health & Beauty', 'slug' => 'health_and_beauty', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        DB::table('categories')->insert(['name' => 'Video Games & Consoles', 'slug' => 'video_games_and_consoles', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
    }
}
