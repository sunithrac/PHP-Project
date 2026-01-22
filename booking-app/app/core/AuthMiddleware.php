<?php
namespace App\Core;

class AuthMiddleware
{
    public static function authenticate(): int
    {
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            throw new \Exception("Token missing");
        }

        $token = str_replace("Bearer ", "", $headers['Authorization']);

        $payload = JWT::decode($token);

        if ($payload['exp'] < time()) {
            throw new \Exception("Token expired");
        }

        return $payload['user_id'];
    }
}
