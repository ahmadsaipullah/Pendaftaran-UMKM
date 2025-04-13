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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('level_id')->default(3); // Foreign key to levels table
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('nik')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_hp')->nullable();
            //relasi ke table levels
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('set default');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
