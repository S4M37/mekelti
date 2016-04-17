<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Metier\MobileService;
use App\Model\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class MobileController extends Controller
{

    protected $mobileService;

    public function __construct(MobileService $mobileService)
    {
        $this->mobileService = $mobileService;
    }

    function signin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        //return $credentials;
        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        $user = User::whereEmail($request->input('email'))->get()->first();
        return response()->json(compact('token', 'user'));
    }

    function signup()
    {

    }

    function logout()
    {

    }
}
