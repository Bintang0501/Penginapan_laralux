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
        Schema::create('keranjang_detail', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("keranjangId", 50);
            $table->string("produk_id", 50);
            $table->integer("qty");
            $table->double("harga");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang_detail');
    }
};