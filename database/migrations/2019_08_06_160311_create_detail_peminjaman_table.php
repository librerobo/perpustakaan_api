<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_peminjaman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('buku_id')->unsigned();
            $table->bigInteger('peminjaman_id')->unsigned();
            $table->foreign('buku_id')->references('id')->on('buku');
            $table->foreign('peminjaman_id')->references('id')->on('peminjaman');
            $table->integer('jumlah');
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
        Schema::dropIfExists('detail_peminjaman');
    }
}
