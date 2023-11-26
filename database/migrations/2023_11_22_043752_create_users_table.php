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
            $table->string('username')->nullable(false)->unique()->index('search_usr');
            $table->string('nombre')->nullable(false);
            $table->string('apellido_paterno')->nullable(false);
            $table->string('apellido_materno')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('fecha_nacimiento')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('ine_address')->nullable();
            $table->string('password',255)->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('email_verified_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
