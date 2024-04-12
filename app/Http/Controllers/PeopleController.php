<?php

namespace App\Http\Controllers;
namespace App\Models\People;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeopleController extends Controller
{
    public function index()
    {
        $people = People::all();

        if ($people->isEmpty()) {
            $data = [
                'message' => 'No se encontraron datos',
                'status' => 200
            ];
            return response()->json($data, 200);
        }

        return response()->json($people, 200);

    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'role_people' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $people = People::create([
            'id' => $request->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_people' => $request->role_people
        ]);

        if (!$people) {
            $data = [
                'message' => 'Error al crear usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $people,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function destroy($id)
    {
        $people = People::find($id);

        if (!$people) {
            $data = [
                'message' => 'Error al crear usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $people->delete();

        $data = [
            'message' => 'persona eliminado',
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function update($id)
    {
        $people = People::find($id);

        if (!$people) {
            $data = [
                'message' => 'persona no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'email' => 'email',
            'phone' => 'required',
            'role_people' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $people->name = $request->name;
        $people->email = $request->email;
        $people->phone = $request->phone;
        $people->role_people = $request->role_people;

        $people->save();

        $data = [
            'message' => 'persona actualizado',
            'People' => $people,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
