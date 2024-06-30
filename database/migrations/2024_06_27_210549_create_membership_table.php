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
        Schema::create('membership', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('users_id', 50);
            $table->integer('point');
            $table->enum("status", ["1", "0"])->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership');
    }
};
