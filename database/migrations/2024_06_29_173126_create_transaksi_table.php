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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('users_id');
            $table->string('nama_users');
            $table->string('email_users');
            $table->double('total_beli');
            $table->double('pajak');
            $table->double('total_bayar')->nullable();
            $table->double("kembalian")->nullable();
            $table->enum("use_reedem", ["1", "0"])->nullable()->default("0");
            $table->integer("point")->nullable()->default(0);
            $table->dateTime('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
