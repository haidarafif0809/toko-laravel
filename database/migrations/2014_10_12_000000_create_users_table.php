<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->default('2')->nullable()->comment = "(1=user toko), (2=staf toko)";
            $table->integer('toko_id')->nullable();
            $table->string('nama_toko')->nullable();
            $table->string('nama_pemilik');
            $table->string('email')->unique();
            $table->string('no_telp');
            $table->boolean('status')->default(1)->comment      = "(0= tdk aktif)(1= aktif)";
            $table->boolean('is_verified')->default(0)->comment = "(0= nonverifikasi)(1= terverifikasi)";
            $table->string('verification_token')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
