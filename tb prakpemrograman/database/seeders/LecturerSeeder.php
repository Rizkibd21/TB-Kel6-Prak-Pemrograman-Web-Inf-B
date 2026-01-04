<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class LecturerSeeder extends Seeder
{
    public function run(): void
    {
        $lecturers = [
            [
                'name' => 'Dr. Asep Sunandar, M.T.',
                'email' => 'asep@example.com',
                'password' => 'password',
                'role' => 'dosen',
                'nidn' => '0011223344',
            ],
            [
                'name' => 'Dra. Siti Aminah, M.Kom.',
                'email' => 'siti@example.com',
                'password' => 'password',
                'role' => 'dosen',
                'nidn' => '0022334455',
            ],
            [
                'name' => 'Budi Raharjo, Ph.D.',
                'email' => 'budi@example.com',
                'password' => 'password',
                'role' => 'dosen',
                'nidn' => '0033445566',
            ],
            [
                'name' => 'Prof. Bambang Setiawan',
                'email' => 'bambang@example.com',
                'password' => 'password',
                'role' => 'dosen',
                'nidn' => '0044556677',
            ],
        ];

        foreach ($lecturers as $lecturer) {
            User::updateOrCreate(['email' => $lecturer['email']], $lecturer);
        }
    }
}
