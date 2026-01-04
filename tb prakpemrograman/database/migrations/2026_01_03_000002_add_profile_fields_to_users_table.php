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
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'nidn')) {
                $table->string('nidn')->nullable()->after('email'); // Nomor Induk Dosen
            }
            if (! Schema::hasColumn('users', 'nim')) {
                $table->string('nim')->nullable()->after('nidn');   // Nomor Induk Mahasiswa
            }
            if (! Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('nim');
            }
            if (! Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable()->after('phone');
            }
            if (! Schema::hasColumn('users', 'gender')) {
                $table->enum('gender', ['L', 'P'])->nullable()->after('address');
            }
            if (! Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('gender');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nidn', 'nim', 'phone', 'address', 'gender', 'avatar']);
        });
    }
};
