<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Cabinets;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CabinetsController extends Controller
{
    
    /* ------------------------------------------
    /  API Endpoints for Cabinets
    / ------------------------------------------ */

    public function api_index(){
        $cabinets=Cabinets::all();
        return response()->json($cabinets);
    }

    public function api_store(Request $request){
        $request->validate([
            'adresse'=>'required',
            'fixe'=>'required',
            'mobile'=>'required',
            'email'=>'required|email',
            'id_ville'=>'required',
            'id_specialite'=>'required'
        ]);
        $existe=Cabinets::where('adresse',$request->adresse)->first();
        if($existe){
            return response()->json([
                'error'=>'cabinet already exists'
            ],409);
        }
        try {
            Cabinets::create([
                'adresse'=>$request->adresse,
                'fixe'=>$request->fixe,
                'mobile'=>$request->mobile,
                'email'=>$request->email,
                'id_ville'=>$request->id_ville,
                'id_specialite'=>$request->id_specialite
            ]);
            return response()->json(['success'=>'cabinet created successfully'],201);
        } catch (QueryException $e) {
            return response()->json([
                'error'=>'error while creating cabinet'
            ],500);
        }
    }
    public function api_update(Request $request){
        $cabinet=Cabinets::find($request->id_cabinet);
        if(!$cabinet){
            return response()->json([
                'error'=>'cabinet not found'
            ],404);
        }
        $cabinet->adresse=$request->adresse;
        $cabinet->fixe=$request->fixe;
        $cabinet->mobile=$request->mobile;
        $cabinet->email=$request->email;
        $cabinet->id_ville=$request->id_ville;
        $cabinet->id_specialite=$request->id_specialite;
        try {
            $cabinet->save();
            return response()->json([
                'success'=>'Cabinet updated successfully',
                'Cabinet'=>$cabinet
            ],200);
        } catch (QueryException $e) {
           return response()->json([
            'error'=>'error while updating cabinet'
           ],500);
        }
    }

    public function api_show($id_cabinet){
        $cabinet=Cabinets::find($id_cabinet);
        if(!$cabinet){
            return response()->json([
                'error'=>'Cabinet not found'
            ],404);
        }
        return response()->json($cabinet);
    }

    public function api_destroy($id_cabinet){
        $cabinet=Cabinets::find($id_cabinet);
        if(!$cabinet){
            return response()->json([
                'error'=> 'cabinet not found'
            ],404);
        }
        try {
            $cabinet->delete();
            return response()->json([
                'success'=>'Cabinet deleted successfully'
            ],201);
        } catch (QueryException $e) {
            return response()->json([
                'error'=>'error while deleting cabinet',
                'error'=>$e
            ],500);
        }
    }
}
