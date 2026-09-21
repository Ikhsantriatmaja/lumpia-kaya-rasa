<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
        {
            Schema::table('metode_pembayaran', function (Blueprint $table) {

                $table->string('qris')->nullable()->after('nama_metode');

            });
        }

        public function down(): void
        {
            Schema::table('metode_pembayaran', function (Blueprint $table) {

                $table->dropColumn('qris');

            });
        }
};
