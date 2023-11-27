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
        Schema::create('invitaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('torneo_id');
            $table->unsignedBigInteger('equipo_id');
            $table->datetime('expire_at');
            $table->foreign('user_id')
            ->references('id')
            ->on('users');
            $table->foreign('equipo_id')
            ->references('id')
            ->on('equipos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('torneo_id')
            ->references('id')
            ->on('torneos')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitaciones');
    }
};
