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
        Schema::create('dokumen_permohonans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonan_id')->constrained('permohon ans')->onDelete('cascade');
            $table->string('nama_dokumen');
            $table->string('file_path');
            $table->string('status')->default('Pending');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_permohonans');
    }
};
