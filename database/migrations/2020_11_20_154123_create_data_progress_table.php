<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_vitamin')->nullable();
            $table->unsignedBigInteger('id_kandang');
            $table->dateTime('ket_waktu');
            $table->integer('sisa_ternak');
            $table->text('perkembangan');
            $table->text('keluhan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_progress');
    }
}
