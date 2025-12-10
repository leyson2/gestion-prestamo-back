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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained('equipos');
            $table->string('nombre_solicitante', 100);
            $table->string('dni_solicitante', 20);
            $table->string('correo');
            $table->enum('estado', ['SOLICITADO', 'ENTREGADO','DEVUELTO'])->default('SOLICITADO');
            $table->date('fecha_prestamo');
            $table->text('comentario_final')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
