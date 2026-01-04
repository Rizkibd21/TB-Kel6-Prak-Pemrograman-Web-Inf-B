<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure there is an active academic year
        $academicYear = AcademicYear::updateOrCreate(
            ['name' => '2025/2026', 'semester' => 'Ganjil'],
            ['is_active' => true]
        );

        // 2. Get a lecturer to be an advisor (optional but good for data integrity)
        $advisor = User::where('role', 'dosen')->first();

        // 3. Create Classrooms (Rooms)
        $classrooms = [
            ['name' => 'Ruang A-203'],
            ['name' => 'Ruang B-101'],
            ['name' => 'Lab Komputer 1'],
            ['name' => 'Lab Multimedia'],
            ['name' => 'Ruang Teori 5'],
        ];

        foreach ($classrooms as $classroom) {
            Classroom::updateOrCreate(
                ['name' => $classroom['name']],
                [
                    'academic_year_id' => $academicYear->id,
                    'advisor_id' => $advisor ? $advisor->id : null,
                ]
            );
        }
    }
}
