<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_user');
            $table->unsignedBigInteger('id_member');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_hp');
            $table->string('role')->default('customer');
            $table->string('total_transaksi')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_member')->references('id_member')->on('members')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

