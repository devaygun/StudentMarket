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
        /* Seeds with fundamental website content with some test data */
        $this->call([
            UserTableSeeder::class,
            CategoryTableSeeder::class,
            ItemTableSeeder::class,
            ReviewTableSeeder::class,
            MessageTableSeeder::class,
            ImageTableSeeder::class,
            CommentTableSeeder::class,
        ]);

        /* Factories (used to generate large amounts of dynamic test data) */
        factory(App\User::class, 50)->create();
        factory(App\Item::class, 50)->create();

    }
}
