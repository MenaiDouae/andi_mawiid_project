<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PatientsController extends Controller
{
    // GET /api/patients
    public function api_index()
    {
        $patients = Patients::all();
        return response()->json($patients);
    }

    // POST /api/patients
    public function api_store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'cnie' => 'nullable|string|max:20|unique:patients',
            'date_naissance' => 'nullable|date',
            'adresse' => 'nullable|string',
            'num_tel' => 'nullable|string|max:20',
            'sexe' => 'nullable|integer|in:1,2',
        ]);

        try {
            $patient = Patients::create($request->all());
            return response()->json([
                'success' => 'Patient created successfully',
                'patient' => $patient
            ], 201);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error while creating patient'], 500);
        }
    }

    // GET /api/patient/{id_patient}
    public function api_show($id_patient)
    {
        $patient = Patients::find($id_patient);
        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }

        return response()->json($patient);
    }

    // PUT /api/patient/{id_patient}
    public function api_update(Request $request, $id_patient)
    {
        $patient = Patients::find($id_patient);
        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'cnie' => 'nullable|string|max:20|unique:patients,cnie,' . $id_patient . ',id_patient',
            'date_naissance' => 'nullable|date',
            'adresse' => 'nullable|string',
            'num_tel' => 'nullable|string|max:20',
            'sexe' => 'nullable|integer|in:1,2',
        ]);

        try {
            $patient->update($request->all());
            return response()->json([
                'success' => 'Patient updated successfully',
                'patient' => $patient
            ], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error while updating patient'], 500);
        }
    }

    // DELETE /api/patient/{id_patient}
    public function api_destroy($id_patient)
    {
        $patient = Patients::find($id_patient);
        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }

        try {
            $patient->delete();
            return response()->json(['success' => 'Patient deleted successfully'], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error while deleting patient'], 500);
        }
    }
}
