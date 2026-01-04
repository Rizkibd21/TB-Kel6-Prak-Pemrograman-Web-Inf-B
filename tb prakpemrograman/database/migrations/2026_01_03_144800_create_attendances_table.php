<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop old table if exists to start fresh with new structure
        Schema::dropIfExists('attendances');

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Mahasiswa
            $table->date('date');
            $table->time('time_in')->nullable();
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alfa'])->default('alfa');

            // Verification data
            $table->enum('method', ['manual', 'qr', 'gps'])->default('manual');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();

            $table->text('notes')->nullable(); // For izin/sakit description
            $table->string('evidence_file')->nullable(); // For izin/sakit letter

            $table->timestamps();

            // Prevent double attendance per schedule per day
            $table->unique(['schedule_id', 'user_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
