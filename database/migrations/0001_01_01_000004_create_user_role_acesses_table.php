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
        Schema::create('user_role_accesses', function (Blueprint $table) {
            $table->unsignedTinyInteger('role');
            $table->string('resource');
            $table->boolean('allow')->default(true);
            $table->primary(['role', 'resource']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_role_accesses');
    }
};
