<?php

namespace App\Metier;

use App\model\User;

class MobileService
{
    function getUser($id_User)
    {
        return User::find($id_User);
    }
}