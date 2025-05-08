<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('public_donations', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->decimal('nominal', 12, 2);
            $table->string('pesan')->nullable();
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_donations');
    }
};
