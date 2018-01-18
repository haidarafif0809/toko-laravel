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
            $table->increments('id');
            $table->string('no_faktur')->nullable();
            $table->string('toko_id')->nullable();
            $table->string('pelanggan_id')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('pajak')->nullable();
            $table->string('diskon')->nullable();
            $table->string('total_bayar')->nullable();
            $table->string('cara_bayar')->nullable();
            $table->string('keterangan')->nullable();
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
