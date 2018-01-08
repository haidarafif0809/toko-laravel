<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelanggansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_pelanggan')->nullable();
            $table->string('nama_pelanggan');
            $table->date('tanggal_lahir')->nullable();
            $table->string('nomor_telepon');
            $table->string('alamat')->nullable();
            $table->integer('jenis_kelamin')->comment = "1 = laki_laki , 2 = perempuan";
            $table->string('email')->nullable();
            $table->string('kota')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('catatan')->nullable();
            $table->string('toko_id')->nullable();
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
        Schema::dropIfExists('pelanggans');
    }
}
