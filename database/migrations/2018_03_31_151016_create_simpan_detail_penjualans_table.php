<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimpanDetailPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simpan_detail_penjualans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_faktur')->nullable();
            $table->integer('id_satuan');
            $table->integer('id_produk');
            $table->string('id_modifier')->nullable();
            $table->integer('id_penjualan');
            $table->integer('harga_produk');
            $table->integer('jumlah_produk');
            $table->integer('diskon')->nullable();
            $table->integer('subtotal');
            $table->unsignedInteger('created_by')->nullable()->index();
            $table->unsignedInteger('updated_by')->nullable()->index();
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
        Schema::dropIfExists('simpan_detail_penjualans');
    }
}
