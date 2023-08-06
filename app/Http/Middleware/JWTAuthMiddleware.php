<?php

namespace App\Http\Middleware;
use App\Helpers\JWTHelper;
use Closure;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT; // Asegúrate de importar la clase JWT correctamente

class JWTAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');
        
        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        
            $jwtHelper = new JWTHelper();
            $decodedToken = $jwtHelper->verifyToken($token);
            // El token es válido, permitir acceso a la ruta
            return $next($request);
        
    }
  
}
