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
            $table->integer('kategori_produks_id')->nullable();
            $table->integer('toko_id')->nullable();
            $table->integer('bisa_dijual')->nullable()->comment = "1 = Ya, 0 = Tidak";
            $table->string('foto')->nullable();
            $table->string('satuan')->nullable()
                ->comment = "1 = Pcs, 2 = Porsi, 3 = Pack, Lainnya = Lainnya";
            $table->string('produk_modifier_id')->nullable();
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
