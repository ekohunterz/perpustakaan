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
        Schema::create('kepseks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nip')->unique();
            $table->enum('jk', ['Laki-Laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('alamat');
            $table->string('hp');
            $table->enum('status', ['PNS', 'Honorer']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepseks');
    }
};
