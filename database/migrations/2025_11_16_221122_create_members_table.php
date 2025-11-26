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
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            // External unique reference
            $table->string('external_id')->unique(); // bioguideId

            // Basic info
            $table->string('name');
            $table->string('party')->nullable();
            $table->string('state')->nullable();
            $table->unsignedInteger('district')->nullable();

            // Media
            $table->string('image_url')->nullable();
            $table->string('image_attribution')->nullable();

            // Terms (array of objects)
            $table->json('terms')->nullable();

            // Original source URL
            $table->string('source_url')->nullable();

            // External update timestamp
            $table->timestamp('external_updated_at')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
