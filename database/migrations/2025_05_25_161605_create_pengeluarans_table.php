<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaransTable extends Migration
{
    public function up()
    {
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('deskripsi');
            $table->bigInteger('jumlah');
            $table->string('kategori')->nullable(); // Contoh: "Operasional", "Program", dll
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengeluarans');
    }
}
