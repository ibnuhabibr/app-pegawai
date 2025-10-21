<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Tambahkan kolom setelah kolom tanggal_masuk [cite: 4279]
            $table->unsignedBigInteger('departemen_id')->after('tanggal_masuk');
            // Tambahkan kolom setelah kolom departemen_id [cite: 4280]
            $table->unsignedBigInteger('jabatan_id')->after('departemen_id');

            // Definisikan foreign key ke tabel departments [cite: 4281, 4282, 4305, 4306]
            $table->foreign('departemen_id')
                  ->references('id')
                  ->on('departments')
                  ->onDelete('cascade'); // Hapus employee jika department dihapus

            // Definisikan foreign key ke tabel positions [cite: 4285, 4286, 4309, 4310]
            $table->foreign('jabatan_id')
                  ->references('id')
                  ->on('positions')
                  ->onDelete('cascade'); // Hapus employee jika position dihapus
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Hapus foreign key constraints dulu [cite: 4294, 4295]
            $table->dropForeign(['departemen_id']);
            $table->dropForeign(['jabatan_id']);
            // Hapus kolomnya [cite: 4296]
            $table->dropColumn(['departemen_id', 'jabatan_id']);
        });
    }
};
