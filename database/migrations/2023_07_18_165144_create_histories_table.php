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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id')->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->integer('book_id')->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->integer('pinjam_id')->foreign('pinjam_id')->references('id')->on('pinjams')->onDelete('cascade');
            $table->date('tgl_pinjam');
            $table->date('batas_tgl_kembali');
            $table->date('tgl_kembali')->nullable();
            $table->string('kondisi_buku_saat_dipinjam');
            $table->string('kondisi_buku_saat_dikembalikan')->nullable();
            $table->bigInteger('denda')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
