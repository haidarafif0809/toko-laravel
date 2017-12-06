<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_kas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jenis_transaksi')->comment = "(1 = kas masuk), (2 = kas keluar)";
            $table->integer('jumlah_masuk')->default(0);
            $table->integer('jumlah_keluar')->default(0);
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
        Schema::dropIfExists('transaksi_kas');
    }
}
