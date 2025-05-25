<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('campaign_donations', function (Blueprint $table) {
            $table->string('email')->after('nama');
            $table->string('telepon')->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('campaign_donations', function (Blueprint $table) {
            $table->dropColumn(['email', 'telepon']);
        });
    }
};
