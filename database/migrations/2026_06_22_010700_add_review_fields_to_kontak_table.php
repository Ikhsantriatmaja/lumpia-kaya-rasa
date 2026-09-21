<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kontak', function (Blueprint $table) {

            $table->integer('rating')
                  ->nullable()
                  ->after('pesan');

            $table->string('foto_produk')
                  ->nullable()
                  ->after('rating');

            $table->text('balasan_admin')
                  ->nullable()
                  ->after('foto_produk');

        });
    }

    public function down(): void
    {
        Schema::table('kontak', function (Blueprint $table) {

            $table->dropColumn([
                'rating',
                'foto_produk',
                'balasan_admin'
            ]);

        });
    }
};