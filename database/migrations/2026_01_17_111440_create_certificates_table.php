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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('candidate_name');
            $table->string('domain')->nullable();
            $table->string('type'); // e.g., Internship, Offer Letter
            $table->string('layout_type')->default('default');
            $table->string('unique_id')->unique();
            $table->text('content')->nullable();
            $table->string('heading')->nullable();
            $table->json('logos')->nullable(); // Store selected Logo IDs/Names
            $table->string('signature')->nullable();
            $table->timestamp('issued_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
