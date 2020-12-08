<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembukuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembukuan', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal');
            $table->string('nama', 30);
            $table->text('keterangan');
            $table->integer('debit')->nullable();
            $table->integer('kredit')->nullable();
            $table->string('jenis', 11);
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
        Schema::dropIfExists('pembukuan');
    }
}
