<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            ['name' => 'Junior', 'level' => 1],
            ['name' => 'Middle', 'level' => 2],
            ['name' => 'Senior', 'level' => 3],
            ['name' => 'Lead', 'level' => 4],
            ['name' => 'Manager', 'level' => 5],
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}
