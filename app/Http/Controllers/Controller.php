<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
* @OA\Info(
*    title="Api's Clinica Recoleta", 
*    version="1.0")
* @OA\Server(url="https://endpoint.centrooftalmorecoleta.net")
* @OA\Server(url="http://localhost:8000")
* @OA\SecurityScheme(
*     type="http",
*     description="Login with email and password to get the authentication token",
*     name="Token based Based",
*     in="header",
*     scheme="bearer",
*     bearerFormat="JWT",
*     securityScheme="apiAuth",
* )
*/
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function isJsonResponse($response)
    {
        return $response instanceof \Illuminate\Http\JsonResponse;
    }
}
