<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_users');
            $table->dateTime('tanggal');
            $table->dateTime('batas_pembayaran');
            $table->string('status_order', 20);
            $table->integer('nominal');
            $table->integer('banyak_item');
            $table->string('rekening', 16)->nullable();
            $table->string('atas_nama', 30)->nullable();
            $table->integer('jumlah_transfer')->nullable();
            $table->string('bukti', 100)->nullable();
            $table->timestamps();

            $table->foreign('id_produk')->references('id')->on('produk')->onDelete('cascade');
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
