<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('code')->unique();
            $table->string('type')->index();
            $table->unsignedInteger('amount')->nullable();
            $table->unsignedInteger('percentage')->nullable();
            $table->unsignedInteger('max_percentage_amount')->nullable();
            $table->timestamp('expired_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
