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
            $table->increments('produk_id');
            $table->string('kode_produk');
            $table->string('nama_produk');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->string('satuans_id');
            $table->string('kategori_produks_id')->nullable();
            $table->string('status_jual')->nullable();
            $table->string('foto')->nullable();
            $table->string('berkaitan_dgn_stok')->nullable();
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
