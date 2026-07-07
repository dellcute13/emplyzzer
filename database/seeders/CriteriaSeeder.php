<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criterias = [
            ['code' => 'C1',  'name' => 'KPI Historis (2020-2022)',          'weight' => 0.23, 'attribute' => 'benefit', 'description' => 'Rata-rata nilai KPI historis 2020-2022. Bukti dasar kuat atas performance pekerjaan.'],
            ['code' => 'C2',  'name' => 'KPI Terkini (2023-2024)',            'weight' => 0.12, 'attribute' => 'benefit', 'description' => 'Rata-rata nilai KPI 2023-2024. Nilai akhir dikurangi 15 sebagai sistem normalisasi.'],
            ['code' => 'C3',  'name' => 'Penilaian Atasan',                   'weight' => 0.17, 'attribute' => 'benefit', 'description' => 'Penilaian langsung dari atasan. Tier 1=100, Tier 2=85, Tier 3=70, Tier 4=55.'],
            ['code' => 'C4',  'name' => 'Disiplin & Etika',                   'weight' => 0.08, 'attribute' => 'benefit', 'description' => 'Penilaian disiplin dan etika. Nilai 0-19, dikonversi ke skala 0-100.'],
            ['code' => 'C5',  'name' => 'Assessment Kompetensi',              'weight' => 0.13, 'attribute' => 'benefit', 'description' => 'Hasil assessment kompetensi oleh pihak ketiga (assessor). Skala 0-100.'],
            ['code' => 'C6',  'name' => 'Bahasa Inggris',                     'weight' => 0.04, 'attribute' => 'benefit', 'description' => 'Nilai kemampuan bahasa Inggris (TOEIC atau setara). Nilai 0-700, dikonversi ke 0-100.'],
            ['code' => 'C7',  'name' => 'Uji Komputer',                       'weight' => 0.03, 'attribute' => 'benefit', 'description' => 'Nilai uji kompetensi komputer. Skala 0-100.'],
            ['code' => 'C8',  'name' => 'Assessment Potential',               'weight' => 0.08, 'attribute' => 'benefit', 'description' => 'Hasil assessment potensi pegawai. Nilai 0-5, dikonversi ke skala 0-100.'],
            ['code' => 'C9',  'name' => 'Nilai IQ',                           'weight' => 0.02, 'attribute' => 'benefit', 'description' => 'Hasil tes IQ pegawai. Dikonversi ke skala 0-100 berdasarkan rentang nilai.'],
            ['code' => 'C10', 'name' => 'Bakat & Minat',                      'weight' => 0.05, 'attribute' => 'benefit', 'description' => 'Hasil assessment bakat dan minat. Perhitungan: 70% Bakat + 30% Minat.'],
            ['code' => 'C11', 'name' => 'Riwayat Pelanggaran Disiplin',       'weight' => 0.05, 'attribute' => 'cost',    'description' => 'Riwayat pelanggaran disiplin. Poin: Teguran=1, SP1=3, SP2=4, SP3=5. Cost criteria.'],
        ];

        foreach ($criterias as $criteria) {
            Criteria::create($criteria);
        }
    }
}