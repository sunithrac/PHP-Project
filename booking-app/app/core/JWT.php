<?php

    namespace App\Core;

    class JWT {
        private static string $secret = "MY_SECRET_KEY_123";

        public static function encode(array $payload): string
        {
            $header = base64_encode(json_encode(["alg" => "HS256", "typ" => "JWT"]));
            $payload = base64_encode(json_encode($payload));

            $signature = hash_hmac(
                "sha256",
                "$header.$payload",
                self::$secret,
                true
            );

            $signature = base64_encode($signature);

            return "$header.$payload.$signature";
        }

        public static function decode(string $token): array
        {
            [$header, $payload, $signature] = explode('.', $token);

            $valid = base64_encode(
                hash_hmac(
                    "sha256",
                    "$header.$payload",
                    self::$secret,
                    true
                )
            );

            if ($signature !== $valid) {
                throw new \Exception("Invalid token");
            }

            return json_decode(base64_decode($payload), true);
        }
    }
?>
