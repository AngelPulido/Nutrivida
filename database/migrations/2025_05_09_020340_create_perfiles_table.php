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
        Schema::create('perfiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->string('telefono', 20)->nullable();
            $table->integer('edad')->nullable();
            $table->string('genero', 10)->nullable();
            $table->text('direccion')->nullable();
            $table->integer('altura_cm')->nullable();
            $table->integer('peso_kg')->nullable();
            $table->string('especialidad', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfiles');
    }
};
