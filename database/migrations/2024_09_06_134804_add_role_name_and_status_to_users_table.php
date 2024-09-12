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
        Schema::table('users', function (Blueprint $table) {
            $table->json('role_name')->nullable(); // Add JSON column for roles
            $table->boolean('status')->default(0); // Add boolean column with default value 0
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role_name'); // Drop JSON column if rolling back
            $table->dropColumn('status'); // Drop boolean column if rolling back
        });
    }
};
