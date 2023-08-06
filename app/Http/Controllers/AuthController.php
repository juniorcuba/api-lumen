<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Helpers\JWTHelper;

class AuthController extends Controller
{   

    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6',
            ]);
    
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            $user->save();
    
            return response()->json(['message' => 'User registered successfully'], 201);
        } catch (\Exception $e) {
            die("No se pudo conectar a la base de datos: " . $e->getMessage());
        }
       
    }

    public function login(Request $request)
    {   
        
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $jwtHelper = new JWTHelper();
        $token = $jwtHelper->generateToken(['user_id' => $user->id]);

        return response()->json(['token' => $token]);
    }
    
    public function verifyToken(Request $request)
    {
        $token = $request->header('Authorization');
        
        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }
        $jwtHelper = new JWTHelper();
        $decodedToken = $jwtHelper->verifyToken($token);
        
        if (!$decodedToken) {
            return response()->json(['message' => 'Invalid token'], 401);
        }
        
        $userId =  $decodedToken['user_id'];;
        
        $user = User::find($userId);
        
        return response()->json(['user' => $user]);
    }
}
