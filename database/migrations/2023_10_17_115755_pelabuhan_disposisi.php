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
        Schema::create('pelabuhan_disposisi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('pelabuhan_surat_masuk_id');
            $table->foreign('pelabuhan_surat_masuk_id')->on('pelabuhan_surat_masuk')->references('id');
            $table->string('tujuan');
            $table->date('batas_waktu_tindaklanjuti');
            $table->enum('jenis_disposisi', ['Segera', 'Biasa']);
            $table->enum('status_disposisi', ['Belum Ditindaklanjuti', 'Selesai', 'Terlewati']);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelabuhan_disposisi');
    }
};
