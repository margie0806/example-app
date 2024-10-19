<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Agenda;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'identificacion',
        'nombres',
        'apellidos',
        'correo',
        'direccion',
        'telefono',
        'tipocontrato',
        'datesemana',
    ];

    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }


public function getFechasDisponibles()
{
    $citasAgendadas = $this->agendas()->pluck('fecha')->map(function($fecha) {
        return Carbon::parse($fecha)->format('Y-m-d H:i:s');
    })->toArray(); // Convertir a array para facilitar la comparación

    $fechaInicio = Carbon::now();
    $fechaFin = $fechaInicio->copy()->addDays(30); // Mantiene el rango de 30 días

    $fechasDisponibles = [];

    for ($date = $fechaInicio->copy(); $date->lessThanOrEqualTo($fechaFin); $date->addDay()) {
        $formattedDate = $date->format('Y-m-d H:i:s');
        if (!in_array($formattedDate, $citasAgendadas)) { // Usar in_array para verificar existencia
            $fechasDisponibles[] = $formattedDate; // Acumular fechas
        }
    }

    return array_values(array_unique($fechasDisponibles)); // Asegurarse que son únicas
}


}
