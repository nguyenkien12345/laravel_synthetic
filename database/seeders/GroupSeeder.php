<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            'A' => ['Hà Lan', 'Senegal', 'Ecuador', 'Qatar'],
            'B' => ['Anh', 'USA', 'Iran', 'Wales'],
            'C' => ['Argentina', 'Ba Lan', 'Mexico', 'Saudi Arabia'],
            'D' => ['Pháp', 'Australia', 'Tunisia', 'Đan mạch'],
        ];

        foreach ($groups as $group => $teams) {
            $groupModel = Group::updateOrCreate(['name' => $group]);

            foreach ($teams as $team) {
                $groupModel->teams()->create(['name' => $team]);
            };
        }
    }
}
