<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    // CRUD Functions API

    public function api_index()
    {
        $personnels = Personnel::all();
        return response()->json($personnels);
    }

    public function api_store(Request $request)
    {
        $data = $request->only([
            'nom',
            'prenom',
            'cnie',
            'adresse',
            'num_tel',
            'sexe'
        ]);

        try {
            Personnel::create($data);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error has been encountered'], 500);
        }

        return response()->json([
            'success' => 'Personnel created successfully',
        ], 201);
    }

    public function api_show($id_personnel)
    {
        $personnel = Personnel::find($id_personnel);
        if (!$personnel)
            return response()->json([
                'error' => 'Personnel not found'
            ], 404);

        return response()->json($personnel);
    }

    public function api_update(Request $request, $id_personnel)
    {
        $personnel = Personnel::find($id_personnel);
        if (!$personnel)
            return response()->json([
                'error' => 'Personnel not found'
            ], 404);

        $personnel->fill($request->only([
            'nom',
            'prenom',
            'cnie',
            'adresse',
            'num_tel',
            'sexe'
        ]));

        try {
            $personnel->save();
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'Error has been encountered while saving the updating entity!'
            ], 500);
        }

        return response()->json([
            'success' => 'Personnel has been updated successfully!',
            'personnel' => $personnel
        ], 200);
    }

    public function api_destroy($id_personnel)
    {
        $personnel = Personnel::find($id_personnel);
        if (!$personnel)
            return response()->json([
                'error' => 'Personnel not found'
            ], 404);

        $personnel->delete();

        return response()->json([
            'success' => 'Personnel has been deleted successfully!'
        ], 200);
    }
}
