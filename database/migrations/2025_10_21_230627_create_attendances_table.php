<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id'); // [cite: 4331]
            $table->date('tanggal'); // [cite: 4334]
            $table->time('waktu_masuk')->nullable(); // [cite: 4335]
            $table->time('waktu_keluar')->nullable(); // [cite: 4336]
            $table->enum('status_absensi', ['hadir', 'izin', 'sakit', 'alpha']); // [cite: 4337]
            $table->timestamps();

            // Foreign key constraint ke employees [cite: 4340, 4341, 4342, 4343]
            $table->foreign('karyawan_id')
                  ->references('id')
                  ->on('employees')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
