<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelolaKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelola_kas', function (Blueprint $table) {
            $table->increments('kelola_kas_id');
            $table->integer('toko_id');
            $table->integer('type')->comment = "(1 = kas masuk), (2 = kas keluar)";
            $table->integer('jumlah');
            $table->string('keterangan');
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
        Schema::dropIfExists('kelola_kas');
    }
}
