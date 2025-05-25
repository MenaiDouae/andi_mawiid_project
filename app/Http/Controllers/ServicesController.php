<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    // CRUD Functions API

    public function api_index()
    {
        $services = Services::all();
        return response()->json($services);
    }

    public function api_store(Request $request)
    {
        $service_name = $request->service_name;
        $prix = $request->prix;
        try {
            Services::create([
                'service_name' => $service_name,
                'prix' => $prix
            ]);
        }catch(QueryException $e) {
            return response()->json(['error' => 'Error has been encountered'], 500);
        }

        return response()->json([
            'success' => 'Service created successfully',
        ], 201);
    }

    public function api_show($id_service)
    {
        $service = Services::find($id_service);
        if(!$service)
            return response()->json([
                'error' => 'Service not found'
            ], 404);
        
        return response()->json($service);
    }

    public function api_update(Request $request, $id_service)
    {
        $service = Services::find($id_service);
        if(!$service)
            return response()->json([
                'error' => 'Service not found'
            ], 404);

        $service->service_name = $request->service_name;
        $service->prix = $request->prix;
        try {
            $service->save();
        }catch(QueryException $e){
            return response()->json([
                'error' => 'Error has been encountered while saving the updating entity!'
            ], 500);
        }

        return response()->json([
            'success' => 'Service has been updated Successfully!',
            'service' => $service
        ], 200);
    }

    public function api_destroy($id_service)
    {
        $service = Services::find($id_service);
        if(!$service)
            return response()->json([
                'error' => 'Service not found'
            ], 404);

        $service->delete();

        return response()->json(
            ['success' => 'Service has been deleted successfully!']
        , 200);
    }
}
