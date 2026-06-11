<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('donasi', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->after('id');
            $table->string('jumlah_barang')->nullable()->after('jumlah_donasi');
            $table->string('metode_penyaluran')->nullable()->after('jumlah_barang');
            $table->string('bukti_transfer')->nullable()->after('metode_penyaluran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donasi', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'jumlah_barang', 'metode_penyaluran', 'bukti_transfer']);
        });
    }
};
