<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id_produk');
            $table->string('kategori');
            $table->string('nama_produk');
            $table->text('deskripsi_produk');
            $table->integer('stok_produk');
            $table->decimal('harga_produk', 10, 2);
            $table->string('foto_produk')->nullable();
            $table->string('status_produk');
            $table->text('riwayat_service')->nullable();
            $table->integer('total_disewa')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}

