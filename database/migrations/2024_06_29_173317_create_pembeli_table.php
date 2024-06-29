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
        Schema::create('pembeli', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("no_ktp", 50);
            $table->string("user_id", 50);
            $table->enum("jenis_kelamin", ["Laki - Laki", "Perempuan"]);
            $table->text("alamat");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembeli');
    }
};
