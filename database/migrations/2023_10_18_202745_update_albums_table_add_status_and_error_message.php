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
        Schema::table('albums', function ($table) {
            $table->enum('status', ['draw', 'pending', 'finished', 'failed'])->after('layout')->default('draw');
            $table->string('error_message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('albums', function ($table) {
            $table->dropColumn('status');
            $table->dropColumn('error_message');
        });
    }
};
