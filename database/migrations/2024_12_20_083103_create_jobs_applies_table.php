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
        Schema::create('jobs_applies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jobsapply_id')->constrained('jobs_creates')->onDelete('cascade');
            $table->string('full_name');
            $table->string('email');
            $table->string('cv_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs_applies');
    }
};
