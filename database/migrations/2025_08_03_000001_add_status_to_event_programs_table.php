<?php

use App\Enums\EventProgram\EventProgramStatusEnum;
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
        Schema::table('event_programs', function (Blueprint $table) {
            $table->string('status')->default(EventProgramStatusEnum::InProgress);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_programs', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
