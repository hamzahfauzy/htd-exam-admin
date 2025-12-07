<?php

namespace Core;

class JwtAuth
{
    static function get()
    {
        $token   = getBearerToken();
        $secret  = env('JWT_SECRET','secret');
        $decode  = self::decode($token, $secret);

        $db   = new Database;
        $db->query = "SELECT id, name, username FROM users WHERE id = $decode->user_id";
        $user = $db->exec('single');

        return $user;
    }

    static function decode($jwt)
    {
        $tokenParts = explode('.', $jwt);
        $payload = base64_decode($tokenParts[1]);
    
        return json_decode($payload);
    }

    function generate_jwt($headers, $payload, $secret) {
        $headers_encoded = $this->base64url_encode(json_encode($headers));
        
        $payload_encoded = $this->base64url_encode(json_encode($payload));
        
        $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
        $signature_encoded = $this->base64url_encode($signature);
        
        $jwt = "$headers_encoded.$payload_encoded.$signature_encoded";
        
        return $jwt;
    }

    function base64url_encode($str) {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
    }
    
    static function base64url_encoder($str) {
        return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
    }

    function generate($payload)
    {
        $headers = array('alg'=>'HS256','typ'=>'JWT');
        $secret  = env('JWT_SECRET','secret');
        return $this->generate_jwt($headers, $payload, $secret);
    }

    static function validateBearerToken()
    {
        return getBearerToken() && self::is_valid(getBearerToken());
    }

    static function is_valid($jwt) {
        $secret = env('JWT_SECRET','secret');
        $tokenParts = explode('.', $jwt);
        
        if(count($tokenParts) < 3) return false;

        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signature_provided = $tokenParts[2];
    
        // build a signature based on the header and payload using the secret
        $base64_url_header = self::base64url_encoder($header);
        $base64_url_payload = self::base64url_encoder($payload);
        $signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
        $base64_url_signature = self::base64url_encoder($signature);
    
        // verify it matches the signature provided in the jwt
        $is_signature_valid = ($base64_url_signature === $signature_provided);
        
        return $is_signature_valid;
    }
}