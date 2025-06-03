<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email|max:255|exists:users,email',
                'password' => 'required|min:8',
            ]);
            // Attempt to authenticate the user
            if(Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'token' => $token,
                    'user' => $user
                ]);
            }
            return response()->json([
                'error' => "Votre adresse éléctronique ou mot de passe incorrect!",
            ], 401);
        }catch (ThrottleRequestsException $e){
            return response()->json([
                'error' => 'Trop de tentative de connexion. Veuillez réessayer plus tard!'
            ], 429);
        }
    }
    
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        if($request->hasSession())
        {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return response()->json([
            'success' => 'Logged Out'
        ], 200);
    }

    public function user(Request $request)
    {
        return response()->json($request->user()->load('userable', 'roles'));
    }

    public function resetPassword(Request $request, $id_user)
    {
        $request->validate([
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8'
        ]);
        $user = User::find($id_user);
        if(!$user) 
            return response()->json([
                'error' => 'Utilisateur non trouvé!'
            ], 404);
        // Check if the current old password is the same as the record
        if(Hash::check($request->current_password, $user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return response()->json([
                'success' => 'Réinitialisation du mot de passe réussie',
            ]);
        }
        return response()->json([
            'error' => 'Le mot de passe actuel est incorrect!',
        ], 401);
    }
}
