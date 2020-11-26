<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kecamatan_id')->nullable();
            $table->unsignedBigInteger('id_role')->nullable();
            $table->string('name');
            $table->string('username', 30);
            $table->string('email')->unique();
            $table->string('noHp', 13);
            $table->timestamp('email_verified_at')->nullable();
            $table->text('alamat');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
