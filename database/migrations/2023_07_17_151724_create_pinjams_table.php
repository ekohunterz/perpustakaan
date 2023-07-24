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
        Schema::create('pinjams', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id')->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->integer('book_id')->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->string('kondisi_buku');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjams');
    }
};
