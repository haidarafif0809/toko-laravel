<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('produk_id');
            $table->string('kode_produk');
            $table->string('nama_produk');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->string('kategori_produks_id')->nullable();
            $table->string('toko_id')->nullable();
            $table->integer('status_jual')->nullable()->comment = "1 = Ya, 0 = Tidak";
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('produks');
    }
}
