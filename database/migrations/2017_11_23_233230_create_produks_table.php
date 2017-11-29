<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_produk');
            $table->string('kode_barcode')->nullable();
            $table->string('nama_produk');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->integer('harga_jual2')->nullable();
            $table->integer('harga_jual3')->nullable();
            $table->integer('harga_jual4')->nullable();
            $table->integer('harga_jual5')->nullable();
            $table->integer('harga_jual6')->nullable();
            $table->integer('harga_jual7')->nullable();
            $table->integer('stok_produk')->nullable();
            $table->string('satuans_id');
            $table->string('kategori_produks_id')->nullable();
            $table->string('gudangs_id')->nullable();
            $table->string('status')->nullable();
            $table->string('supliers_id')->nullable();
            $table->string('stok_awal')->nullable();
            $table->string('foto')->nullable();
            $table->integer('limit_stok')->nullable();
            $table->integer('over_stok')->nullable();
            $table->string('berkaitan_dgn_stok')->nullable();
            $table->string('jenis_produk')->nullable();
            $table->string('tipe_produk')->nullable();
            $table->string('golongan')->nullable();
            $table->string('golongan_produk')->nullable();
            $table->string('stok_opname')->nullable();
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
        Schema::dropIfExists('produks');
    }
}
