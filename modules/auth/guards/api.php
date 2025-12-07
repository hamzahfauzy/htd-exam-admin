<?php

use Core\JwtAuth;
use Core\Response;

$allowedRouteWithoutGuard = [
    env('API_PREFIX','api') . '/auth/login'
];

if(!in_array($route, $allowedRouteWithoutGuard))
{
    if(!JwtAuth::validateBearerToken() || empty(jwtAuth()))
    {
        echo Response::json([], 'Unauthorized', 401);
        die();
    }
}