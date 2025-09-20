<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        User::create([
            'name' => 'Иванов',
            'email' => 'info@datainlife.ru',
        ]);

        User::create([
            'name' => 'Петров',
            'email' => 'job@datainlife.ru',
        ]);
    }
}
