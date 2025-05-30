<?php

namespace App\Http\Controllers;

use App\Models\Traitements;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TraitementsController extends Controller
{
    public function api_index()
    {
        $traitements = Traitements::with(['service', 'facture'])->get();
        return response()->json($traitements);
    }

    public function api_store(Request $request)
    {
        $request->validate([
            'id_service' => 'required|exists:services,id_service',
            'id_facture' => 'required|exists:factures,id_facture',
            
        ]);

        try {
            $traitements = Traitements::create($request->all());
            return response()->json([
                'success' => 'Traitement created successfully',
                'traitement' => $traitements->load(['service', 'facture'])
            ], 201);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error while creating traitement'], 500);
        }
    }

    public function api_show($id_traitement)
    {
        $traitement = Traitements::with(['service', 'facture'])->find($id_traitement);
        if (!$traitement) {
            return response()->json(['error' => 'Traitement not found'], 404);
        }
        return response()->json($traitement);
    }

    public function api_update(Request $request, $id_traitement)
    {
        $traitement = Traitements::find($id_traitement);
        if (!$traitement) {
            return response()->json(['error' => 'Traitement not found'], 404);
        }

        $request->validate([
            'id_service' => 'required|exists:services,id_service',
            'id_facture' => 'required|exists:factures,id_facture',

        ]);

        try {
            $traitement->update($request->all());
            return response()->json([
                'success' => 'Traitement updated successfully', 
                'traitement' => $traitement->load(['service', 'facture'])]);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error while updating traitement'], 500);
        }
    }

    public function api_destroy($id_traitement)
    {
        $traitement = Traitements::find($id_traitement);
        if (!$traitement) {
            return response()->json(['error' => 'Traitement not found'], 404);
        }

        try {
            $traitement->delete();
            return response()->json(['success' => 'Traitement deleted successfully']);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error while deleting traitement'], 500);
}  
}
}
?>