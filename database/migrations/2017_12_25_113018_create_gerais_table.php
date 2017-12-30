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
            $table->integer('toko_id')->nullable();
            $table->string('nama_gerai');
            $table->string('alamat_gerai')->nullable();
            $table->string('kota')->nullable();
            $table->string('no_telepon_a')->nullable();
            $table->string('no_telepon_b')->nullable();
            $table->string('notes')->nullable();
            $table->string('nama_pajak')->nullable();
            $table->string('rasio')->nullable();
            $table->integer('meja')->default(0)->nullable()->comment = "0 = null, 1 = meja";
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
