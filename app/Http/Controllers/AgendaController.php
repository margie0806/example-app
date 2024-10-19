<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendaController extends Controller
{
    
   
public function index()
{
    // Obtiene todos los empleados para mostrarlos en la vista
    $lempleado = Empleado::all();

    // Obtiene las fechas disponibles para cada empleado
    $fechasDisponibles = [];
    foreach ($lempleado as $empleado) {
        $fechasDisponibles[$empleado->id] = $empleado->getFechasDisponibles();
    }

    return view('agendacita.index', ['lempleado' => $lempleado, 'fechasDisponibles' => $fechasDisponibles]);
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

    public function update(Request $request, $id)
    {
        // Valida los datos enviados en el formulario
        $request->validate([
            'nombres' => 'required|string|max:255',
            'correo' => 'required|string|max:255',
            'telefono' => 'required',
            'tiposervicio' => 'required|string|max:255',
            'fecha' => 'required|date|after:today',
            'empleado_id' => 'required|exists:empleados,id',  // Asegúrate de que el empleado exista
        ]);

        // Busca la agenda por su ID
        $agenda = Agenda::findOrFail($id);

        // Actualiza los datos de la agenda con los valores enviados en el formulario
        $agenda->update([
            'nombres' => $request->input('nombres'),
            'correo' => $request->input('correo'),
            'telefono' => $request->input('telefono'),
            'tiposervicio' => $request->input('tiposervicio'),
            'fecha' => $request->input('fecha'),
            'empleado_id' => $request->input('empleado_id'),  // Asegúrate de que este campo se esté recibiendo
        ]);

        // Mensaje de éxito
        session()->flash('success', 'Datos actualizados correctamente');

        // Retornar a la ruta de lista de empleados
        return to_route('editarAgendados.index', ['id' => $id]);
    }

    public function editAgendado($id)
    {
        // Busca la agenda por su ID
        $agenda = Agenda::findOrFail($id);

        // Obtén la lista de empleados
        $lempleado = Empleado::all();

        // Retorna la vista con la agenda y los empleados
        return view('editarAgendados.index', compact('agenda', 'lempleado'));
    }

    // Método para mostrar el formulario de creación de citas
    public function create()
    {
        $lempleado = Empleado::all(); // Obtén todos los empleados

        // Lógica para obtener las fechas disponibles de cada empleado
        $fechasDisponibles = [];
        foreach ($lempleado as $empleado) {
            // Aquí podrías tener una función que devuelva las fechas disponibles para cada empleado.
            $fechasDisponibles[$empleado->id] = $empleado->getFechasDisponibles(); // Asegúrate de definir este método en el modelo Empleado
        }

        return view('agendacita.create', compact('lempleado', 'fechasDisponibles'));
    }

    public function obtenerFechasDisponibles($empleado_id)
    {
        $empleado = Empleado::findOrFail($empleado_id);
        $fechasDisponibles = $empleado->getFechasDisponibles();

        return response()->json($fechasDisponibles);
    }

    // Método para almacenar una nueva cita
    public function store(Request $request)
    {
        // Validación y captura de datos validados
        $validatedData = $request->validate([
            'nombres' => 'required|string|max:255',
            'correo' => 'required|email',
            'telefono' => 'required|string|max:15',
            'tiposervicio' => 'required|string|max:255',
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
