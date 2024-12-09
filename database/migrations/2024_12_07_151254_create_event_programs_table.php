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
        Schema::create('event_programs', function (Blueprint $table) {
            $table->id();
            $table->string('gender')->index();
            $table->string('title');
            $table->text('short_description');
            $table->text('content');
            $table->unsignedInteger('min_participants')->default(0);
            $table->unsignedInteger('max_participants')->nullable();
            $table->unsignedInteger('min_age')->default(0);
            $table->unsignedInteger('max_age')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->timestamp('published_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_programs');
    }
};
