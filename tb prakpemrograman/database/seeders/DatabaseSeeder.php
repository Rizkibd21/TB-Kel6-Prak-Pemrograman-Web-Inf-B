<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Dosen User',
            'email' => 'dosen@example.com',
            'password' => 'password',
            'role' => 'dosen',
        ]);

        User::factory()->create([
            'name' => 'Mahasiswa User',
            'email' => 'mahasiswa@example.com',
            'password' => 'password',
            'role' => 'mahasiswa',
        ]);

        // Seed settings
        \App\Models\Setting::create([
            'key' => 'attendance_tolerance',
            'value' => '15',
            'type' => 'integer',
            'description' => 'Tolerance time for attendance in minutes',
        ]);

        // Run other seeders
        $this->call([
            LecturerSeeder::class,
            ClassroomSeeder::class,
            SubjectSeeder::class,
        ]);
    }
}
