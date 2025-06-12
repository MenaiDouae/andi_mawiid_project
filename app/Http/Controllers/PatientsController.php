<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Models\Patients;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PatientsController extends Controller
{

    public function api_index()
    {
        $patients = Patients::withRelations()->get();
        return response()->json($patients);
    }

    public function api_store(StorePatientRequest $request)
    {
        $data = $request->validated();

        try {
            $patient = Patients::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'cnie' => $request->cnie ?? null,
                'date_naissance' => $request->date_naissance ?? null,
                'adresse' => $request->adresse ?? null,
                'num_tel' => $request->num_tel,
                'sexe' => $request->sexe,
            ]);

            $role = Role::where('name', 'Patient')->first();
            // Create a user for the patient
            $patient->user()->create([
                'name' => $request->nom . ' ' . $request->prenom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            // assign the role to the user
            $patient->user->assignRole($role);

            return response()->json([
                'success' => 'Patient created successfully',
                'patient' => $patient->load('user.roles')
            ], 201);
        } catch (QueryException $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    public function api_show($id_patient)
    {
        $patient = Patients::find($id_patient);
        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }

        return response()->json($patient);
    }

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
