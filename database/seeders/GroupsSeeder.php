<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('groups')->truncate();

        Group::create([
            'name' => 'Группа1',
            'expire_hours' => 1,
        ]);

        Group::create([
            'name' => 'Группа2',
            'expire_hours' => 2,
        ]);
    }
}
