<?php
namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTHelper
{ 

    protected static $key;

    public function __construct()
    {
        self::$key = env('JWT_SECRET');
    }

    public static function generateToken($payload)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600;

        $token = JWT::encode(
            array_merge($payload, ['iat' => $issuedAt, 'exp' => $expirationTime]),
            self::$key,
            'HS256'
        );

        return $token;
    }

    public static function verifyToken($token)
    {   
        try {
            $token_explode = explode(" ", $token);
            $headers = new \stdClass();
            $headers->alg = 'HS256';
            $decoded = JWT::decode($token_explode[1], new Key(env('JWT_SECRET'), 'HS256'));
            return (array) $decoded;
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
