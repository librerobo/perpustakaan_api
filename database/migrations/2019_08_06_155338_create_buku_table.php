<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->string('deskripsi');
            $table->string('pengarang');
            $table->integer('jumlah');
            $table->bigInteger('penerbit_id')->unsigned();
            $table->bigInteger('kategori_id')->unsigned();
            $table->foreign('penerbit_id')->references('id')->on('penerbit');
            $table->foreign('kategori_id')->references('id')->on('kategori');
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
        Schema::dropIfExists('buku');
    }
}
