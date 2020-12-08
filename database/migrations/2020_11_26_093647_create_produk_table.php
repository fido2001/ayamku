<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_progress_detail');
            $table->string('nama_produk');
            $table->integer('harga');
            $table->integer('jumlah_produk');
            $table->string('gambar', 100);
            $table->date('tgl_produk');
            $table->timestamps();

            $table->foreign('id_progress_detail')->references('id')->on('progress_detail')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
