<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendaController extends Controller
{
    // Método para mostrar la lista de citas
    public function index()
    {
        // Obtiene todos los empleados para mostrarlos en la vista
        $lempleado = Agenda::all();
        return view('agendacita.index', ['lempleado' => $lempleado]);
    }

    // Método para mostrar todas las citas agendadas
    public function show(Request $request)
    {
        // Obtiene todas las citas de la tabla Agenda
        $lecitas = Agenda::all();
        return view('citasAgendadas.index', ['lecitas' => $lecitas]); // Se usa 'lecitas' aquí
    }

    // Método para eliminar una cita agendada
    public function destroy($id)
    {
        // Busca la cita en la tabla Agenda
        $agenda = Agenda::findOrFail($id);
        
        // Elimina la cita encontrada
        $agenda->delete();
        
        // Redirige a la vista de citas agendadas
        return to_route('citasAgendadas.index');
    }

    // Método para almacenar una nueva cita
    public function store(Request $request)
    {
        // Validación y captura de datos validados
        $validatedData = $request->validate([
            'nombres' => 'required|string|max:255',
            'correo' => 'required|email',
            'telefono' => 'required|string|max:15', // Puedes ajustar el tamaño según lo que necesites
            'tiposervicio' => 'required|string|max:255', // Añadir validación de tipo
            'empleado_id' => 'required|exists:empleados,id',
            'fecha' => 'required|date_format:Y-m-d\TH:i',
        ]);

        // Formateo de la fecha usando Carbon
        $fecha = Carbon::parse($validatedData['fecha'])->format('Y-m-d H:i:s'); // Ajustado para incluir hora

        // Guardar la nueva cita en la base de datos
        Agenda::create([
            'nombres' => $validatedData['nombres'],
            'correo' => $validatedData['correo'],
            'telefono' => $validatedData['telefono'],
            'tiposervicio' => $validatedData['tiposervicio'],
            'fecha' => $fecha,
            'empleado_id' => $validatedData['empleado_id'],
        ]);

        // Mensaje de éxito y redirección
        session()->flash('success', 'Cita agendada correctamente');
        return redirect()->route('agendacita.index');
    }
}
