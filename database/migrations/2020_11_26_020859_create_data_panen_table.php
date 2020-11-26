<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPanenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_panen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_progress');
            $table->unsignedBigInteger('id_kategori');
            $table->integer('total_ternak');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('id_progress')->references('id')->on('data_progress')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_panen');
    }
}
