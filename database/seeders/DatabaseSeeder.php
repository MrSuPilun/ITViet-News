<?php

namespace Database\Seeders;

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
        // \App\Models\Admin::factory(1)->create();
        // \App\Models\Post::factory(10)->create();
        // \App\Models\User::factory(5)->create();
        \App\Models\Tag::factory(20)->create();
    }
}
