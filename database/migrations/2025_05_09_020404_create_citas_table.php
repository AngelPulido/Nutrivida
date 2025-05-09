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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('nutriologo_id')->constrained('usuarios')->onDelete('cascade');
            $table->timestamp('fecha');
            $table->enum('estado', ['pendiente', 'aprobada', 'rechazada', 'reprogramada', 'completada'])->default('pendiente');
            $table->text('notas')->nullable();
            $table->timestamp('reprogramado_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
