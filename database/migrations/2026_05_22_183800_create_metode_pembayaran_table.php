<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetodePembayaranTable extends Migration
{
    public function up()
    {
        Schema::create('metode_pembayaran', function (Blueprint $table) {

            $table->id('id_metode_pembayaran');

            $table->string('nama_metode');

            $table->string('nomor_pembayaran')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('metode_pembayaran');
    }
}