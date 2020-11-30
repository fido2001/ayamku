<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_progress');
            $table->unsignedBigInteger('id_vitamin')->nullable();
            $table->unsignedBigInteger('id_kategori');
            $table->integer('banyak_telur')->nullable();
            $table->integer('jumlah_ternak');
            $table->integer('ternak_mati')->default(0);
            $table->integer('jumlah_pakan');
            $table->text('perkembangan');
            $table->date('tgl_progress');
            $table->string('ket_waktu');
            $table->timestamps();

            $table->foreign('id_progress')->references('id')->on('progress')->onDelete('cascade');
            $table->foreign('id_vitamin')->references('id')->on('vitamin')->onDelete('cascade');
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
        Schema::dropIfExists('progress_detail');
    }
}
