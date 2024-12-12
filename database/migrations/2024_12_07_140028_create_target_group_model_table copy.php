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
        Schema::create('target_group_model', function (Blueprint $table) {
            $table->id();
            $table->foreignId('target_group_id')->constrained()->cascadeOnDelete();
            $table->morphs('model');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_group_model');
    }
};
