<?php
namespace App\Http\Controllers;

use App\Models\InformationsPersonnelle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class InformationsPersonnellesController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:informations_personnelles',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $personalInformation = $request->only(['nom', 'prenom', 'email']); // Only store necessary fields

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $imageName);
            $personalInformation['image'] = 'images/' . $imageName; // Store image path
        }

        $createdPersonalInformation = InformationsPersonnelle::create($personalInformation);

        return response()->json($createdPersonalInformation, 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:informations_personnelles,email,' . $id,
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $personalInformation = InformationsPersonnelle::findOrFail($id);


        // Update image if provided
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $imageName);
            $personalInformation->image = 'images/' . $imageName; // Store image path
        }

        $personalInformation->update($request->except('image')); 
        return response()->json($personalInformation, 200);
    }

    public function destroy($id)
    {
        $personalInformation = InformationsPersonnelle::findOrFail($id);
        $personalInformation->delete();

        return response()->json(null, 204);
    }
}
