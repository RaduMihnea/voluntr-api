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
        Schema::table('volunteers', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('password');
            $table->date('birthday')->nullable()->after('phone');
            $table->string('summary')->nullable()->after('birthday');
            $table->text('description')->nullable()->after('summary');
            $table->foreignId('city_id')->nullable()->after('description')->constrained('cities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('volunteers', function (Blueprint $table) {
            $table->dropColumn(['phone', 'summary', 'description', 'city_id']);
        });
    }
};
