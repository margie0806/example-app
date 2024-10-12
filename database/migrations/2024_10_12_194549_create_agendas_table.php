<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('agendas', function (Blueprint $table) {
        $table->id();
        $table->string('nombres');
        $table->string('correo');
        $table->string('telefono');
        $table->string('tiposervicio');
        $table->string('empleado'); // Se puede eliminar si no lo necesitas
        $table->dateTime('fecha');
        $table->foreignId('empleado_id')->constrained()->cascadeOnDelete(); // Llave foránea de empleado
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
