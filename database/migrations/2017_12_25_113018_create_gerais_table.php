<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeraisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_gerai');
            $table->string('alamat_gerai');
            $table->string('kota');
            $table->string('no_telepon_1');
            $table->string('no_telepon_2');
            $table->string('notes');
            $table->string('nama_pajak');
            $table->string('rasio_');
            $table->boolean('meja')->default(false);
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
        Schema::dropIfExists('gerais');
    }
}
