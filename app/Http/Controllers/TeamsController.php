<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Validator;

class TeamsController extends Controller
{
    public function index(Request $request)
    {
        $teams = Team::all();

        return response(['teams'=>$teams]);
    }

    public function create(Request $request)
    {
        // Validar los datos del equipo antes de crearlo
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'campus' => 'required|string|max:255',
            'coach' => 'required|string|max:255',
            // Puedes agregar más reglas de validación según tus requisitos
        ]);
    
        // Comprobar si la validación falla
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Crear un nuevo equipo con los datos proporcionados en la solicitud
        $team = new Team;
        $team->name = $request->input('name');
        $team->city = $request->input('city');
        $team->campus = $request->input('campus');
        $team->coach = $request->input('coach');
        // Puedes agregar más asignaciones aquí según tus requisitos
    
        // Guardar el equipo en la base de datos
        $team->save();
    
        // Devolver una respuesta con el equipo creado
        return response()->json(['team' => $team], 201);
    }

    public function delete(Request $request)
    {
        // Buscar el equipo por su ID
        $team = Team::where('id', $request->input('id'));

        // Verificar si el equipo existe
        if (!$team) {
            return response()->json(['error' => 'Team Not Exists'], 404);
        }

        // Eliminar el equipo de la base de datos
        $team->delete();

        // Devolver una respuesta de éxito
        return response()->json(['message' => 'Team deleted'], 200);
    }

    public function update(Request $request)
    {
        // Validar los datos del equipo antes de actualizarlo
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'city' => 'nullable|string|max:255',
            'campus' => 'nullable|string|max:255',
            'coach' => 'nullable|string|max:255',
            // Puedes agregar más reglas de validación según tus requisitos
        ]);
    
        // Comprobar si la validación falla
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Buscar el equipo por su ID
        $team = Team::find($request->input('id'));
    
        // Verificar si el equipo existe
        if (!$team) {
            return response()->json(['error' => 'El equipo no existe'], 404);
        }
    
        // Actualizar los datos del equipo con los datos proporcionados en la solicitud
        if ($request->filled('name')) {
            $team->name = $request->input('name');
        }
        if ($request->filled('city')) {
            $team->city = $request->input('city');
        }
        if ($request->filled('campus')) {
            $team->campus = $request->input('campus');
        }
        if ($request->filled('coach')) {
            $team->coach = $request->input('coach');
        }
        // Puedes agregar más asignaciones aquí según tus requisitos
    
        // Guardar los cambios en el equipo
        $team->save();
    
        // Devolver una respuesta con el equipo actualizado
        return response()->json(['Team updated', 'team' => $team], 200);
    }
        
    
}
