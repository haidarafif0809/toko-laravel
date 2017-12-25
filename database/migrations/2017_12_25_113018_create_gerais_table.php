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
            $table->string('rasio');
            $table->boolean('meja')->default(0)->nullable()->comment = "0 = kosong, 1 = meja";
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
        Schema::dropIfExists('gerais');
    }
}
