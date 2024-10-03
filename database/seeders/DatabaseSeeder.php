<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\TasksSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Wywołaj seedy
        $this->call([
            UsersSeeder::class,
            TasksSeeder::class, 
        ]);
    }
}
