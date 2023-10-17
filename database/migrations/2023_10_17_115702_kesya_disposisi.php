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
        Schema::create('kesya_disposisi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('kesya_surat_masuk_id');
            $table->foreign('kesya_surat_masuk_id')->on('kesya_surat_masuk')->references('id');
            $table->date('tanggal_disposisi');
            $table->date('batas_waktu_tindaklanjuti');
            $table->enum('jenis_disposisi', ['Penting', 'Biasa']);
            $table->enum('status_disposisi', ['Belum Ditindaklanjuti', 'Selesai', 'Ditolak', 'Terlewati']);
            $table->text('komentar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kesya_disposisi');
    }
};
