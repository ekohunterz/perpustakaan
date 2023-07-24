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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('kode_member')->unique();
            $table->integer('user_id')->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nis')->unique();
            $table->string('kelas_id')->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->enum('jk', ['Laki-Laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('alamat');
            $table->string('hp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
