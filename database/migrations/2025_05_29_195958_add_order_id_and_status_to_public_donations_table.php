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
    Schema::table('public_donations', function (Blueprint $table) {
        $table->string('order_id')->nullable()->after('pesan');
        $table->string('status')->default('pending')->after('order_id');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('public_donations', function (Blueprint $table) {
        $table->dropColumn(['order_id', 'status']);
    });
}

};
