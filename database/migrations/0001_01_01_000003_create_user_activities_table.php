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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary()->autoIncrement();
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->string('username', 255)->default('');
            $table->datetime('datetime')->nullable()->default(null); // tidak support milliseconds
            $table->string('type')->default('');
            $table->string('name')->default('');
            $table->text('description');
            $table->json('data')->nullable()->default(null);
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->index('datetime');
            $table->index('type');
            $table->index('username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};
