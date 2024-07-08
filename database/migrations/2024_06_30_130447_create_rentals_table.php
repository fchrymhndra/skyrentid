<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalsTable extends Migration
{
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->bigIncrements('id_order');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_produk');
            $table->string('jaminan');
            $table->date('rental_date');
            $table->date('return_date')->nullable();
            $table->string('payment_method');
            $table->decimal('denda', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->string('status_pinjam')->default('pending');
            $table->string('status_kembali')->default('pending');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rentals');
    }
}

