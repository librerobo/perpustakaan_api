<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denda', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('anggota_id')->unsigned();
            $table->bigInteger('peminjaman_id')->unsigned();
            $table->foreign('anggota_id')->references('id')->on('anggota');
            $table->foreign('peminjaman_id')->references('id')->on('peminjaman');
            $table->integer('total');
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
        Schema::dropIfExists('denda');
    }
}
