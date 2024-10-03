<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Importuj Carbon

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            [
                'name' => 'opdracht 1',
                'status' => 0, 
                'user_id' => 1,
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-09-01 12:20:00'),
            ],
            [
                'name' => 'opdracht 2',
                'status' => 1,
                'user_id' => 2,
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-09-07 08:00:00'),
            ],
            [
                'name' => 'opdracht 3',
                'status' => 1,
                'user_id' => 2,
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-09-14 07:00:00'),
            ],
            [
                'name' => 'opdracht 4',
                'status' => 0,
                'user_id' => 1,
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2021-09-21 11:00:00'),
            ],
            [
                'name' => 'Opdracht Expirens day',
                'status' => 0,
                'user_id' => 1,
                'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', '2022-09-21 11:00:00'),
            ],
        ]);
    }
}
