<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tahun Akademik (Academic Years)
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "2025/2026"
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        // 2. Mata Kuliah (Subjects)
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // e.g. "TI101"
            $table->string('name');
            $table->integer('sks');
            $table->timestamps();
        });

        // 3. Kelas (Classrooms)
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "TI-1A"
            $table->foreignId('academic_year_id')->constrained()->cascadeOnDelete();
            $table->foreignId('advisor_id')->nullable()->constrained('users')->nullOnDelete(); // Dosen Wali
            $table->timestamps();
        });

        // 4. Pivot: Mahasiswa di Kelas (Student Classes)
        Schema::create('classroom_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // The student
            $table->timestamps();
        });

        // 5. Jadwal Kuliah (Schedules)
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('classroom_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Dosen Pengampu
            $table->string('day'); // Senin, Selasa, etc.
            $table->time('start_time');
            $table->time('end_time');
            $table->string('room')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('classroom_user');
        Schema::dropIfExists('classrooms');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('academic_years');
    }
};
