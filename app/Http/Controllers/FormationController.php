<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormationController extends Controller
{

    public function index()
    {
        $formations = Formation::all();
        return response()->json($formations);
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'institution' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $formation = Formation::create($request->all());
        return response()->json($formation, 201);
    }

    
    public function show($id)
    {
        $formation = Formation::findOrFail($id);
        return response()->json($formation);
    }


    public function update(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'institution' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $formation->update($request->all());
        return response()->json($formation, 200);
    }


    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();
        return response()->json(null, 204);
    }
}
