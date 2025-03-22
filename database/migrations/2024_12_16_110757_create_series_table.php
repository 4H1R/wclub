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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('status')->index();
            $table->string('payment_type')->index();
            $table->string('presentation_mode')->index();
            $table->string('title');
            $table->string('short_description');
            $table->text('description');
            $table->unsignedInteger('price')->nullable();
            $table->unsignedInteger('previous_price')->nullable();
            $table->json('faqs')->nullable();
            $table->unsignedInteger('episodes_duration_seconds')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
