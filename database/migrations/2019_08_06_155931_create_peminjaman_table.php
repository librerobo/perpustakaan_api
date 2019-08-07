<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('petugas_id')->unsigned();
            $table->bigInteger('anggota_id')->unsigned();
            $table->foreign('petugas_id')->references('id')->on('petugas')->onDelete('cascade');
            $table->foreign('anggota_id')->references('id')->on('anggota')->onDelete('cascade');
            $table->date('tanggal_kembali');
            $table->enum('status',['meminjam', 'dikembalikan']);
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
        Schema::dropIfExists('peminjaman');
    }
}
