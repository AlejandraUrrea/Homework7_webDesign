<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::create('grades', function (Blueprint $table) {
        $table->id();
        // Relación con la materia
        $table->foreignId('subject_id')->constrained()->onDelete('cascade');
        $table->string('activity_type'); // Tarea, Examen, etc.
        $table->decimal('score', 5, 2);  // Calificación (ej: 9.50)
        $table->date('date');            // Fecha de la actividad
        $table->text('comments')->nullable(); // Espacio opcional para notas
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
