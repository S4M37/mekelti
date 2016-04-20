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
        $user = User::whereEmail($request->input('email'))->get()->first();
        if ($user == null) {
            return response()->json(['error' => 'invalid_user'], 500);
        } else {
            if ($user->valide == 0) {
                return response()->json(['error' => 'inactive_account'], 402);
            } else {
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
                return response()->json(compact('token', 'user'));
            }
        }
    }

    function signup(Request $request)
    {
        return $this->mobileService->store($request);
    }

    function validateEmail($id_user, $validation_code)
    {
        return $this->mobileService->validate($id_user, $validation_code);
    }

    function logout()
    {

    }
}
