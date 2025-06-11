<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Regions;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
class RegionsController extends Controller
{

    /* ------------------------------------------
    /  Frontend for Regions
    / ------------------------------------------ */
    public function index()
    {
        $regions = Regions::all();
        return Inertia::render('Regions/Liste', [
            'regions' => $regions
        ]);
    }
    /* ------------------------------------------
    /  API Endpoints for Regions
    / ------------------------------------------ */
    public function api_index(){
        $regions=Regions::all();
        if($regions->isEmpty()){
            return response()->json([
                'error'=>'aucun région trouvée'
            ],404);
        }
        return response()->json($regions);
    }
    public function api_store(Request $request){
        $request->validate(['region'=>'required']);
        $existe=Regions::where('region',$request->region)->first();
        if($existe){
            return response()->json([
                'error'=>'Region already exists'
            ],409);
        }
        try {
            Regions::create(['region'=>$request->region]);
            return response()->json([
                'success'=>'Region created successfully'
            ],201);
        } catch (QueryException $e) {
            return response()->json([
                'error'=>'Error while creating the region',
            ],500);
        }
    }
    public function api_show($id_region){
        $region=Regions::find($id_region);
        if(!$region){
            return response()->json([
                'error'=>'Region not found'
            ],404);
        }
        return response()->json($region);
    }
    public function api_update(Request $request ,$id_region){
        $region=Regions::find($id_region);
        if(!$region){
            return response()->json([
                'error'=>'Region not found'
            ],404);
        }
        $region->region=$request->region;
        try {
            $region->save();
            return response()->json([
                'success'=>'Region updated successfully',
                'region'=>$region
            ],200);
        } catch (QueryException $e) {
           return response()->json([
            'error'=>'Error while updating region'
        ],500);
        }
    }
    public function api_destroy($id_region){
        $region=Regions::findOrFail($id_region);
        try {
            $region->delete();
            return response()->json([
                'success'=>'Region deleted successfully'
            ],200);
        } catch (QueryException $e) {
            return response()->json([
                'error'=>'Error while deleting the region',
                'message'=>$e
            ],500);
        }
    }
}
