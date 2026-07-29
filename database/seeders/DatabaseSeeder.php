<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        $zacky = User::factory()->create([
            'name' => 'Zacky Sheesh',
            'email' => 'user.zacky@gmail.com',
            'role' => 'Administrator',
            'status' => 'Active',
            'password' => Hash::make('zacky123'),                                           
        ]);
        $zacky->assignRole('Administrator');

        $della = User::factory()->create([
            'name' => 'Della Sheesh',
            'email' => 'user.della@gmail.com',
            'role' => 'Manager',
            'status' => 'Active',
            'password' => Hash::make('della123'),
        ]);
        $della->assignRole('Manager');
        

        $this->call([
            GradeSeeder::class,
            DepartmentSeeder::class,
            PositionSeeder::class,
            PeriodSeeder::class,
            CriteriaSeeder::class,
            EmployeeSeeder::class,
            EvaluationSeeder::class,
        ]);
    }
}
