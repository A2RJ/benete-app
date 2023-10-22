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
        Schema::create('pelabuhan_pbm', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('NO ACTION');
            $table->string('nama');
            $table->date('tanggal_masuk');
            $table->string('asal');
            $table->string('perihal');
            $table->string('lampiran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelabuhan_pbm');
    }
};
