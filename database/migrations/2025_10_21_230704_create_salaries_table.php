<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id'); // [cite: 4357]
            $table->string('bulan', 10); // [cite: 4358]
            $table->decimal('gaji_pokok', 10, 2); // [cite: 4359]
            $table->decimal('tunjangan', 10, 2)->default(0); // [cite: 4360]
            $table->decimal('potongan', 10, 2)->default(0); // [cite: 4361]
            $table->decimal('total_gaji', 10, 2); // [cite: 4362]
            $table->timestamps();

            // Relasi ke tabel employees [cite: 4365, 4366, 4367, 4372]
            $table->foreign('karyawan_id')
                  ->references('id')
                  ->on('employees')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
