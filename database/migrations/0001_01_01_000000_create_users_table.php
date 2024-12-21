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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->rememberToken();
            $table->enum('status',['aktif', 'nonaktif', 'terblokir']);
            $table->string('full_name')->nullable(); // Nullable
            $table->enum('location', [
            'aceh', 'sumatera utara', 'sumatera barat',
            'sumatera selatan', 'riau', 'kepulauan riau', 'jambi'
            ])->nullable(); // Nullable
            $table->foreignId('skill_id')->nullable()->constrained('skills')->onDelete('set null'); // Nullable
            $table->string('experience')->nullable(); // Nullable
            $table->string('company_name')->nullable(); // Nullable
            $table->string('company_location')->nullable(); // Nullable
            $table->string('job_title')->nullable(); // Nullable
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};