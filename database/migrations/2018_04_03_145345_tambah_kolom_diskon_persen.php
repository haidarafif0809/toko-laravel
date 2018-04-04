<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TambahKolomDiskonPersen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simpan_detail_penjualans', function (Blueprint $table) {
            $table->integer('diskon_persen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('simpan_detail_penjualans', function (Blueprint $table) {
            $table->dropColumn('diskon_persen');
        });
    }
}
