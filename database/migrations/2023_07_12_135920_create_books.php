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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kode_buku');
            $table->string('nama_buku');
            $table->string('penerbit');
            $table->string('th_terbit');
            $table->string('isbn');
            $table->unsignedBigInteger('kategori_id')->foreign('kategori_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('kondisi_buku_baik');
            $table->integer('kondisi_buku_rusak');
            $table->text('foto_buku')->nullable();
        });

        Schema::table('books', function (Blueprint $table) {
            $table->integer('stok_buku')->nullable()->storedAs('kondisi_buku_baik + kondisi_buku_rusak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
