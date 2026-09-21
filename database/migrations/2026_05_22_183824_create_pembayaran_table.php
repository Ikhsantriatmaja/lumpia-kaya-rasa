<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {

            $table->id('id_pembayaran');

            $table->unsignedBigInteger('id_pesanan');

            $table->unsignedBigInteger('id_metode_pembayaran');

            $table->string('bukti_pembayaran')->nullable();

            $table->string('status_pembayaran')->default('pending');

            $table->date('tanggal_pembayaran')->nullable();

            $table->timestamps();

            // Foreign Key Pesanan
            $table->foreign('id_pesanan')
                  ->references('id_pesanan')
                  ->on('pesanan')
                  ->onDelete('cascade');

            // Foreign Key Metode Pembayaran
            $table->foreign('id_metode_pembayaran')
                  ->references('id_metode_pembayaran')
                  ->on('metode_pembayaran')
                  ->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}