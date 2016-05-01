<?php

namespace App\Metier;

use App\model\User;
use Mail;

class MobileService
{
    function getUser($id_User)
    {
        return User::find($id_User);
    }

    function store($request)
    {
        $confirmation_code = str_random(40);
        $user = new User;
        $email = $request->input('email');
        $name = $request->input('name');
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($request->input('password'));
        $user->validation_code = $confirmation_code;
        $user->region = $request->input('region');
        $user->save();
        $link = "http://localhost/mekelti/public/mobile/validate/" . $user->id_user . "/" . $confirmation_code;
        Mail::send('validationEmail', ['name' => $name, 'link' => $link], function ($message) use ($email) {
            $message->to($email)->subject('Verification');
        });
        return response()->json(["user" => $user], 200);
    }

    function validate($id_user, $validation_code)
    {
        $user = User::find($id_user);
        if ($user == null) {
            $response = json_encode(array("response" => 0), JSON_FORCE_OBJECT);
        } else {
            if ($validation_code == $user->validation_code) {
                $user->valide = 1;
                $user->save();
                $response = json_encode(array("response" => 1, "user" => $user), JSON_FORCE_OBJECT);
            } else {
                $response = json_encode(array("response" => 2), JSON_FORCE_OBJECT);
            }
        }
        return $response;

    }
}