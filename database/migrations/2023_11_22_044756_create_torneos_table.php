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
        Schema::create('torneos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable(false);
            $table->string('descripcion')->nullable();
            $table->string('logo_img')->nullable();
            $table->string('fecha_inicio')->nullable(false);
            $table->string('fecha_fin')->nullable(false);
            $table->string('ubicacion')->nullable(false);
            $table->unsignedBigInteger('categoria_id')->nullable(false);
            $table->unsignedBigInteger('deporte_id')->nullable(false);
            $table->boolean('privado');
            $table->foreign('categoria_id')
            ->references('id')
            ->on('categorias')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('deporte_id')
            ->references('id')
            ->on('deportes')
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
        Schema::dropIfExists('torneos');
    }
};
