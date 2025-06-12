<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Specialities;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class SpecialitiesController extends Controller
{

    /* ------------------------------------------
    /  Frontend for Specialities
    / ------------------------------------------ */
    public function index(){
        $specialities=Specialities::withRelations()->get();
        return Inertia::render('Specialities/Liste',[
            'specialities'=>$specialities
        ]);
    }

     /* ------------------------------------------
    /  API Endpoints for Specialites
    / ------------------------------------------ */

    public function api_index(){
        $specialities=Specialities::withRelations()->get();
        return response()->json($specialities);
    }

    public function api_store(Request $request){
        $request->validate([
            'designation'=>'required',
        ]);
        $existe=Specialities::where('designation',$request->designation)->first();
        if($existe){
            return response()->json([
                'error'=>'speciality already exists'
            ],409);
        }
        try {
            Specialities::create([
                'designation'=>$request->designation,
            ]);
            return response()->json(['success'=>'speciality created successfully'],201);
        } catch (QueryException $e) {
            return response()->json([
                'error'=>'error while creating speciality'
            ],500);
        }
    }
    public function api_update(Request $request){
        $speciality=Specialities::find($request->id_specialite);
        if(!$speciality){
            return response()->json([
                'error'=>'speciality not found'
            ],404);
        }
        $speciality->designation=$request->designation;
        try {
            $speciality->save();
            return response()->json([
                'success'=>'speciality updated successfully',
                'speciality'=>$speciality
            ],200);
        } catch (QueryException $e) {
           return response()->json([
            'error'=>'error while updating the speciality'
           ],500);
        }
    }

    public function api_show($id_specialite){
        $speciality=Specialities::find($id_specialite);
        if(!$speciality){
            return response()->json([
                'error'=>'spaciality not found'
            ],404);
        }
        return response()->json($speciality);
    }

    public function api_destroy($id_specialite){
        $speciality=Specialities::find($id_specialite);
        if(!$speciality){
            return response()->json([
                'error'=> 'speciality not found'
            ],404);
        }
        try {
            $speciality->delete();
            return response()->json([
                'success'=>'speciality deleted successfully'
            ],201);
        } catch (QueryException $e) {
            return response()->json([
                'error'=>'error while deleting the speciality'
            ],500);
        }
    }
}
