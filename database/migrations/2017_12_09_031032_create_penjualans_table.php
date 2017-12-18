<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->increments('id_penjualan');
            $table->string('total');
            $table->string('pelanggan_id');
            $table->string('status_pembelian');
            $table->string('tunai');
            $table->string('kembalian');
            $table->string('kredit');
            $table->string('nilai_kredit');
            $table->string('cara_bayar');
            $table->string('status_beli_awal');
            $table->string('tanggal_jt_tempo');
            $table->string('keterangan')->nullable();
            $table->string('toko_id');
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
        Schema::dropIfExists('penjualans');
    }
}
