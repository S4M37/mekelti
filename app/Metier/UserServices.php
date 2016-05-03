<?php

namespace App\Metier;

use App\Model\ProposedRecette;
use App\Model\Recette;
use App\Model\User;
use App\Model\UserFavoris;

class UserServices
{

    public function getUser($id_user)
    {
        $user = User::find($id_user);
        if ($user != null) {
            return response()->json(['response' => $user], 200);
        } else {
            return response()->json(['response' => 'user not found'], 404);
        }
    }

    public function delteUser($id_user)
    {
        $user = $this->getUser($id_user);

        if ($user != null) {
            $user->delete();
            return response()->json(['response' => ''], 200);
        } else {
            return response()->json(['response' => 'user not found'], 404);
        }
    }

    public function updateUser($request, $id_user)
    {
        $user = User::find($id_user);
        if ($user != null) {
            if ($request->has(['name'])) {
                $user->name = $request->input('name');
            }
            if ($request->has(['region'])) {
                $user->region = $request->input('region');
            }
            $user->save();
            return response()->json(['response' => $user], 200);
        } else {
            return response()->json(['response' => 'user not found'], 404);
        }
    }

    public function getFavoris($id_user)
    {
        $favoris = UserFavoris::whereIdUser($id_user)->join('recette', 'user_favoris.id_Recette', '=', 'recette.id_Recette')
            ->select('recette.*', 'user_favoris.id_Favoris')->get();
        $response = array();
        foreach ($favoris as $favori) {
            array_push($response, (object)array('recette' => $favori, 'id_Favoris' => $favori->id_Favoris));
        }
        return response()->json(['response' => $response], 200);
    }

    public function storeFavoris($request, $id_user)
    {
        $userFavoris = new UserFavoris();
        $id_Recette = $request->input('id_Recette');
        $recette = Recette::find($id_Recette);
        if ($recette != null) {
            $userFavoris->id_Recette = $request->input('id_Recette');
            $userFavoris->id_User = $id_user;
            $userFavoris->save();
            return response()->json(['response', $userFavoris], 200);
        } else {
            return response()->json(['response', "recette not found"], 404);

        }
    }

    public function deleteFavoris($id_Favoris)
    {
        $userFavoris = UserFavoris::find($id_Favoris);
        if ($userFavoris != null) {
            $userFavoris->delete();
            return response()->json(['response' => ''], 200);
        } else {
            return response()->json(['response' => 'favoris not found'], 404);
        }
    }

    public function getNewsFeed($id_User)
    {
        $recettes = Recette::orderBy('id_Recette', 'desc')->whereIdProposed(0)->get();
        $userFavoris = UserFavoris::whereIdUser($id_User)->get();
        $response = array();
        foreach ($recettes as $recette) {
            if (count($userFavoris) > 0) {
                if (($id_Favoris = $this->exist_favoris($userFavoris, $recette->id_Recette)) > 0) {
                    array_push($response, (object)array('recette' => $recette, 'favoris' => 1, 'favorisId' => $id_Favoris));
                } else if (!$this->exist($response, $recette)) {
                    array_push($response, (object)array('recette' => $recette, 'favoris' => 0, 'favorisId' => 0));
                }
            } else {
                array_push($response, (object)array('recette' => $recette, 'favoris' => 0, 'favorisId' => 0));
            }
        }
        $proposedRecettes = ProposedRecette::where('id_User', '!=', $id_User)->whereValid(1)
            ->join('recette', 'recette.id_Proposed', '=', 'proposed_recette.id_Proposed')
            ->select('recette.*')->get();
        foreach ($proposedRecettes as $recette) {
            if (count($userFavoris) > 0) {
                if (($id_Favoris = $this->exist_favoris($userFavoris, $recette->id_Recette)) > 0) {
                    array_push($response, (object)array('recette' => $recette, 'favoris' => 1, 'favorisId' => $id_Favoris));
                } else if (!$this->exist($response, $recette)) {
                    array_push($response, (object)array('recette' => $recette, 'favoris' => 0, 'favorisId' => 0));
                }
            } else {
                array_push($response, (object)array('recette' => $recette, 'favoris' => 0, 'favorisId' => 0));
            }
        }
        return response()->json(['response' => $response], 200);
    }

    function exist($array, $recette)
    {
        foreach ($array as $item) {
            if ($recette->id_Recette == $item->recette->id_Recette) {
                return true;
            }
        }
        return false;
    }

    private function exist_favoris($userFavoris, $id_Recette)
    {
        foreach ($userFavoris as $item) {
            if ($id_Recette == $item->id_Recette) {
                return $item->id_Favoris;
            }
        }
        return 0;
    }
}