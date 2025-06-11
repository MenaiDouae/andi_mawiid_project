<?php

namespace App\Http\Controllers;

use App\Models\Villes;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VillesController extends Controller
{
    /* ------------------------------------------
    /  Frontend for Villes
    / ------------------------------------------ */
    public function index(){
        $villes=Villes::withRelations()->get();
        return Inertia::render('Villes/Liste',[
            'villes'=>$villes
        ]);
    }

     /* ------------------------------------------
    /  API Endpoints for Villes
    / ------------------------------------------ */

    public function api_index(){
        $villes=Villes::withRelations()->get();
        return response()->json($villes);
    }

    public function api_store(Request $request){
        $request->validate([
            'ville'=>'required',
            'id_region'=>'required'
        ]);
        $ville=$request->ville;
        $id_region=$request->id_region;
        try {
            Villes::create([
                'ville'=>$ville,
                'id_region'=>$id_region
            ]);
            return response()->json(['success'=>'city created successfully'],201);
        } catch (QueryException $e) {
            return response()->json([
                'error'=>'error while creating city'
            ],500);
        }
    }
    public function api_update(Request $request){
        $ville=Villes::find($request->id_ville);
        if(!$ville){
            return response()->json([
                'error'=>'city not found'
            ],404);
        }
        $ville->ville=$request->ville;
        $ville->id_region=$request->id_region;
        try {
            $ville->save();
            return response()->json([
                'success'=>'city updated successfully',
                'city'=>$ville
            ],200);
        } catch (QueryException $e) {
           return response()->json([
            'error'=>'error while updating the city'
           ],500);
        }
    }

    public function api_show($id_ville){
        $ville=Villes::find($id_ville);
        if(!$ville){
            return response()->json([
                'error'=>'city not found'
            ],404);
        }
        return response()->json($ville);
    }

    public function api_destroy($id_ville){
        $ville=Villes::find($id_ville);
        if(!$ville){
            return response()->json([
                'error'=> 'city not found'
            ],404);
        }
        try {
            $ville->delete();
            return response()->json([
                'success'=>'city deleted successfully'
            ],201);
        } catch (QueryException $e) {
            return response()->json([
                'error'=>'error while deleting the city'
            ],500);
        }
    }
}
