<?php
namespace App\Http\Controllers;

use App\Models\Empleado; // Asegúrate de importar el modelo Empleado
use App\Models\Agenda;   // Asegúrate de importar el modelo Agenda
use Illuminate\Http\Request;
use Carbon\Carbon; // Importa Carbon para manejar fechas

class AgendaController extends Controller
{
    // Método para mostrar la agenda
    public function index()
    {
        $lempleado = Empleado::all();
        return view('agendacita.index', ['lempleado' => $lempleado]);
    }

    // Método para almacenar una nueva cita
public function store(Request $request)
{
    // Validaciones
    $validatedData = $request->validate([
        'nombres' => 'required|string|max:255',
        'correo' => 'required|email',
        'telefono' => 'required|string|max:15',
        'tiposervicio' => 'required|string|max:50',
        'fecha' => 'required|date',
        'empleado_id' => 'required|exists:empleados,id',
    ]);

    // Formateo de fecha usando Carbon
   $fecha = Carbon::parse($validatedData['fecha'])->format('Y-m-d');



    // Guardar la nueva cita
    Agenda::create([
        'nombres' => $validatedData['nombres'],
        'correo' => $validatedData['correo'],
        'telefono' => $validatedData['telefono'],
        'tiposervicio' => $validatedData['tiposervicio'],
        'fecha' => $fecha, // Fecha correctamente asignada
        'empleado_id' => $validatedData['empleado_id'],
    ]);

    // Mensaje de éxito
    session()->flash('success', 'Cita agendada correctamente');
    return redirect()->route('agenda.index');
}
}