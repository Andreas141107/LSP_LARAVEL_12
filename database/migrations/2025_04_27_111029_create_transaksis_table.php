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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')->constrained(
                table:'pesanans',
                indexName:'pesanan_id'
            )->cascadeOnDelete();
            $table->foreignId('menu_id')->constrained(
                table:'menus',
                indexName:'menu_id'
            )->cascadeOnDelete();
            $table->integer('subtotal');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
