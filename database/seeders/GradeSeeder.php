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
            ['name' => '1.A', 'level' => 1],
            ['name' => '1.B', 'level' => 2],
            ['name' => '1.C', 'level' => 3],
            ['name' => '2.A', 'level' => 4],
            ['name' => '2.B', 'level' => 5],
            ['name' => '2.C', 'level' => 6],
            ['name' => '3.A', 'level' => 7],
            ['name' => '3.B', 'level' => 8],
            ['name' => '3.C', 'level' => 9],
            ['name' => '4.A', 'level' => 10],
            ['name' => '4.B', 'level' => 11],
            ['name' => '4.C', 'level' => 12],
            ['name' => '5.A', 'level' => 13],
            ['name' => '5.B', 'level' => 14],
            ['name' => '5.C', 'level' => 15],
            ['name' => '6.A', 'level' => 16],
            ['name' => '6.B', 'level' => 17],
            ['name' => '6.C', 'level' => 18],
            ['name' => '7.A', 'level' => 19],
            ['name' => '7.B', 'level' => 20],
            ['name' => '7.C', 'level' => 21],
            ['name' => '8.A', 'level' => 22],
            ['name' => '8.B', 'level' => 23],
            ['name' => '8.C', 'level' => 24],
            ['name' => '9.A', 'level' => 25],
            ['name' => '9.B', 'level' => 26],
            ['name' => '9.C', 'level' => 27],
            ['name' => '10.A', 'level' => 28],
            ['name' => '10.B', 'level' => 29],
            ['name' => '10.C', 'level' => 30],
            ['name' => '11.A', 'level' => 31],
            ['name' => '11.B', 'level' => 32],
            ['name' => '11.C', 'level' => 33],
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}

