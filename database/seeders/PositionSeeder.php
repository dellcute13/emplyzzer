<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            [
                'name' => 'Senior Analyst',
                'grade_id' => 3
            ],
            [
                'name' => 'Division Head',
                'grade_id' => 5
            ],
            [
                'name' => 'Lead Engineer',
                'grade_id' => 4
            ],
            [
                'name' => 'Marketing Manager',
                'grade_id' => 5
            ],
            [
                'name' => 'Operation Staff',
                'grade_id' => 2
            ],
        ];

        foreach ($positions as $position) {
            Position::create($position);
        }
    }
}
