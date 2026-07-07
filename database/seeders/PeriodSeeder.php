<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Period;
use Carbon\Carbon;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($year = 2024; $year <= 2030; $year++) {

            // Semester 1
            Period::updateOrCreate(
                [
                    'semester' => '1',
                    'year' => $year,
                ],
                [
                    'name' => "Semester 1 {$year}",
                    'start_date' => Carbon::create($year, 1, 1),
                    'end_date' => Carbon::create($year, 6, 30),
                    'is_active' => false,
                ]
            );

            // Semester 2
            Period::updateOrCreate(
                [
                    'semester' => '2',
                    'year' => $year,
                ],
                [
                    'name' => "Semester 2 {$year}",
                    'start_date' => Carbon::create($year, 7, 1),
                    'end_date' => Carbon::create($year, 12, 31),
                    'is_active' => $year === now()->year,
                ]
            );
        }
    }
}