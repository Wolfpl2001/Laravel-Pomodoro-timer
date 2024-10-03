<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tasks extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            'name' => 'opdracht 1',
        ]);
        DB::table('tasks')->insert([
            'name' => 'opdracht 2',
        ]);
        DB::table('tasks')->insert([
            'name' => 'opdracht 3',
        ]);
        DB::table('tasks')->insert([
            'name' => 'opdracht 4',
        ]);
    }
}
