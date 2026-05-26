<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maleNames = [
            'Aditya Pratama',
            'Budi Santoso',
            'Rizky Ramadhan',
            'Fajar Nugroho',
            'Dimas Saputra',
            'Ahmad Fauzi',
            'Reza Maulana',
            'Yoga Pratama',
            'Andi Wijaya',
            'Teguh Hidayat',
            'Rian Kurniawan',
            'Raka Mahendra',
            'Iqbal Ramadhan',
            'Ardiansyah Putra',
            'Bayu Prakoso',
            'Hendra Gunawan',
            'Farhan Akbar',
            'Ilham Saputra',
            'Kevin Prasetyo',
            'Mochammad Rizal',
            'Naufal Hakim',
            'Rendy Saputra',
            'Satria Mahesa',
            'Vino Saputra',
            'Yusuf Maulana'
        ];

        $femaleNames = [
            'Siti Rahayu',
            'Indah Lestari',
            'Dewi Anggraini',
            'Putri Maharani',
            'Nadia Safitri',
            'Aulia Rahman',
            'Citra Permata',
            'Bella Nadzira',
            'Kartika Sari',
            'Rina Amelia',
            'Tiara Ayuningtyas',
            'Wulan Sari',
            'Yuni Kartika',
            'Lina Marlina',
            'Maya Putri',
            'Nabila Zahra',
            'Olivia Natasha',
            'Puspa Dewi',
            'Qonita Azzahra',
            'Rani Oktavia',
            'Shania Putri',
            'Tasya Maharani',
            'Ulfa Khairunnisa',
            'Vania Aurellia',
            'Zahra Amelia'
        ];

        $employees = [];

        // 25 laki-laki
        foreach ($maleNames as $index => $name) {

            $employees[] = [
                'nip' => '1990' . str_pad($index + 1, 8, '0', STR_PAD_LEFT),

                'name' => $name,

                'gender' => 'L',

                'photo' => 'assets/images/default-user.png',

                'position_id' => rand(1, 5),

                'department_id' => rand(1, 5),

                'join_date' => now()
                    ->subDays(rand(30, 1500))
                    ->format('Y-m-d'),

                'status' => rand(0, 1)
                    ? 'permanent'
                    : 'contract',

                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // 25 perempuan
        foreach ($femaleNames as $index => $name) {

            $employees[] = [
                'nip' => '1991' . str_pad($index + 1, 8, '0', STR_PAD_LEFT),

                'name' => $name,

                'gender' => 'P',

                'photo' => 'assets/images/default-user.png',

                'position_id' => rand(1, 5),

                'department_id' => rand(1, 5),

                'join_date' => now()
                    ->subDays(rand(30, 1500))
                    ->format('Y-m-d'),

                'status' => rand(0, 1)
                    ? 'permanent'
                    : 'contract',

                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Employee::insert($employees);
    }
}
