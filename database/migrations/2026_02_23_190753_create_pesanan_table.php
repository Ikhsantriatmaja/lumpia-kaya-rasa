<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {

            $table->id('id_pesanan');

            $table->unsignedBigInteger('id_pelanggan');

            $table->date('tanggal_pesanan');

            $table->integer('total_harga');

            $table->string('status_pesanan')->default('pending');

            $table->timestamps();

            // Foreign Key
            $table->foreign('id_pelanggan')
                  ->references('id_pelanggan')
                  ->on('pelanggan')
                  ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};