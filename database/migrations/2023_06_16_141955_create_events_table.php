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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->timestamp('starts_at')->index();
            $table->timestamp('ends_at')->index();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('required_volunteers_amount')->unsigned();
            $table->tinyInteger('minimum_participant_age')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
