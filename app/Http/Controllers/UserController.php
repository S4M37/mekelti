<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Metier\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function getUser($id_user)
    {
        return $this->userServices->getUser($id_user);
    }

    public function deleteUser($id_user)
    {
        return $this->userServices->delteUser($id_user);
    }

    public function updateUser(Request $request, $id_user)
    {
        return $this->userServices->updateUser($request, $id_user);
    }

    public function getFavoris($id_user)
    {
        return $this->userServices->getFavoris($id_user);
    }

    public function storeFavoris(Request $request, $id_user)
    {
        return $this->userServices->storeFavoris($request, $id_user);
    }

    public function deleteFavoris($id_User, $id_Favoris)
    {
        return $this->userServices->deleteFavoris($id_Favoris);
    }

    public function getNewsFeed($id_User)
    {
        return $this->userServices->getNewsFeed($id_User);
    }
}
