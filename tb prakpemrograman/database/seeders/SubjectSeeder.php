<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            ['code' => 'MK001', 'name' => 'Pendidikan Agama', 'sks' => 2],
            ['code' => 'MK002', 'name' => 'Matematika Dasar', 'sks' => 3],
            ['code' => 'MK003', 'name' => 'Bahasa Inggris', 'sks' => 2],
            ['code' => 'MK004', 'name' => 'Pemrograman Dasar', 'sks' => 3],
            ['code' => 'MK005', 'name' => 'Struktur Data', 'sks' => 3],
            ['code' => 'MK006', 'name' => 'Jaringan Komputer', 'sks' => 3],
            ['code' => 'MK007', 'name' => 'Basis Data', 'sks' => 3],
            ['code' => 'MK008', 'name' => 'Pancasila & Kewarganegaraan', 'sks' => 2],
        ];

        foreach ($subjects as $subject) {
            Subject::updateOrCreate(['code' => $subject['code']], $subject);
        }
    }
}
