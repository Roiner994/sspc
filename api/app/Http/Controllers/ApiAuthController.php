<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class ApiAuthController extends Controller
{
    
    public function __construct(){
        $this->middleware('cors');
    }

    public function prueba($id){
        return $id;
    }

    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([]);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $usuario = JWTAuth::toUser($token);
        // all good so return the token
        $code=1;
        return response()->json($usuario->toArray());
    }

    
}
