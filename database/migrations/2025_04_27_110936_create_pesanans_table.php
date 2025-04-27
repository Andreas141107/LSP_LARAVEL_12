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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained(
                table:'pelanggans',
                indexName:'pelanggan_id'
            )->cascadeOnDelete();
            $table->foreignId('meja_id')->nullable()->constrained(
                table:'mejas',
                indexName:'meja_id'
            );
            $table->integer('total_harga');
            $table->integer('kembalian')->nullable();
            $table->integer('uang_diberikan')->nullable();
            $table->string('status');
            $table->foreignId('user_id')->constrained(
                table:'users',
                indexName:'user_id'
            )->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
