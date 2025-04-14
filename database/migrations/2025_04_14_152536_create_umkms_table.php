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
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_umkm');
            $table->string('jenis_usaha');
            $table->text('alamat_umkm');
            $table->string('kelurahan');
            $table->string('kecamatan')->default('Sepatan');
            $table->string('kabupaten')->default('Kabupaten Tangerang');
            $table->string('provinsi')->default('Banten');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
