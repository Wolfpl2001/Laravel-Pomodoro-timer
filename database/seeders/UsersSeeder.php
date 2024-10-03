<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder // Użyj CamelCase w nazwie klasy
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Użyj tablicy do wstawienia wielu rekordów na raz
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin.com', // Dodano .com do adresu e-mail
                'password' => bcrypt('admin1234'),
            ],
            [
                'name' => 'user',
                'email' => 'user@user.com', // Dodano .com do adresu e-mail
                'password' => bcrypt('user1234'),
            ],
        ]);
    }
}
