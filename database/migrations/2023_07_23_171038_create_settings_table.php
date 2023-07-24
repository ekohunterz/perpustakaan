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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('alamat_sekolah');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('telp');
            $table->string('email');
            $table->text('logo')->nullable();
            $table->double('denda_terlambat');
            $table->double('denda_rusak');
            $table->double('denda_hilang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
