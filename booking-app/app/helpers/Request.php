<?php
namespace app\helpers;

class Request
{
    public static function all(): array
    {
        $raw = file_get_contents("php://input");
        $json = json_decode($raw, true);

        if (is_array($json)) {
            return $json;
        }

        return $_POST ?? [];
    }

    public static function input(string $key, $default = null)
    {
        $data = self::all();
        return $data[$key] ?? $default;
    }
}