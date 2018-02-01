<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ItemTableSeeder::class);
        $this->call(ReviewTableSeeder::class);
        $this->call(MessageTableSeeder::class);
        $this->call(ImageTableSeeder::class);
        $this->call(CommentTableSeeder::class);
    }
}
