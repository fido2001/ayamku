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
            $table->integer('ternak_sehat');
            $table->integer('ternak_sakit');
            $table->text('perkembangan');
            $table->date('tgl_progress');
            $table->text('keluhan')->nullable();
            $table->text('saran')->nullable();
            $table->timestamps();

            $table->foreign('id_progress')->references('id')->on('data_progress')->onDelete('cascade');
            $table->foreign('id_vitamin')->references('id')->on('vitamin')->onDelete('cascade');
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
