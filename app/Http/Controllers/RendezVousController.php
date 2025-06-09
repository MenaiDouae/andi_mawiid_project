<?php

namespace App\Http\Controllers;

use App\Models\RendezVous;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    public function api_index()
    {
        $rendezVous = RendezVous::withRelations()->get();
        return response()->json($rendezVous);
    }

    public function api_store(Request $request)
    {
        $request->validate([
            'date_rendez_vous' => 'required|string',
            'heure_rendez_vous' => 'required',
            'etat' => 'nullable|in:0,1,2',
            'id_patient' => 'required',
            'id_service' => 'required',
            'id_cabinet' => 'required',
        ]);

        //Check if an appointment already exists at the same date and time
        $existe = RendezVous::where('date_rendez_vous', $request->date_rendez_vous)
            ->where('heure_rendez_vous', $request->heure_rendez_vous)->exists();
        if ($existe) {
            return response()->json(['error' => 'An appointment already exists at this time'], 422);
        }
        try {
            $rendezVous = RendezVous::create($request->all());
            return response()->json([
                'success' => 'rendezVous created successfully',
                'rendezVous' => $rendezVous,
            ], 201);
        } catch (QueryException $e) {
            return response()->json([
                'error' => 'error while creating Appointment '
            ], 500);
        };
    }

    public function api_show($id_rendez_vous)
    {
        $rendezVous = RendezVous::find($id_rendez_vous);
        if (!$rendezVous) {
            return response()->json(['error' => 'Appointment not found'], 404);
        }
        return response()->json($rendezVous);
    }

    public function api_update(Request $request, $id_rendez_vous)
    {
        $rendezVous = RendezVous::find($id_rendez_vous);
        if (!$rendezVous) {
            return response()->json(['error' => 'Appointment not found'], 404);
        }
        $request->validate([
            'date_rendez_vous' => 'required|date',
            'heure_rendez_vous' => 'required',
            'etat' => 'nullable|in:0,1,2',
            'id_patient' => 'required',
            'id_service' => 'required',
            'id_cabinet' => 'required',
        ]);
        $existe = RendezVous::where('date_rendez_vous', $request->date_rendez_vous)
            ->where('heure_rendez_vous', $request->heure_rendez_vous)
            ->where('id_rendez_vous', '!=', $id_rendez_vous)->exists();
        if ($existe) {
            return response()->json(['error' => 'An appointment already exists at this time'], 422);
        }
        try {
            $rendezVous->update($request->all());
            return response()->json(['success' => 'Appointment updated succesfully'], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'error while updating Appointment'], 500);
        }
    }

    public function api_destroy($id_rendez_vous)
    {
        $rendezVous = RendezVous::find($id_rendez_vous);
        if (!$rendezVous) {
            return response()->json(['error' => 'Appointment not found'], 404);
        }
        try {
            $rendezVous->delete();
            return response()->json(['success' => 'Appointment deleted successfuly'], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error while deleting Appointment'], 500);
        }
    }
}
