<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class,5)->create();
        factory(App\Model\Product::class,100)->create();
        factory(App\Model\Review::class,500)->create();
    }
}
