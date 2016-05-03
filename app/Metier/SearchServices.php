<?php

namespace App\Metier;

use App\Model\ProposedRecette;
use App\Model\Recette;
use App\Model\UserFavoris;

class SearchServices
{

    public function searchByAll($get, $id_User)
    {
        $recettes = Recette::orderBy('id_Recette', 'desc')
            ->where(function ($query) use ($get) {
                $query->where('label', 'like', '%' . $get . '%')
                    ->orWhere('type', 'like', '%' . $get . '%')
                    ->orWhere('description', 'like', '%' . $get . '%');
            })->whereIdProposed(0)
            ->get();
        $response = array();
        if ($id_User == 0) {
            foreach ($recettes as $item) {
                array_push($response, (object)array('favoris' => '0', 'favorisId' => '0', 'recette' => $item));
            }
            $proposedRecettesByLabel = ProposedRecette::whereValid(1)
                ->join('recette', 'recette.id_Proposed', '=', 'proposed_recette.id_Proposed')
                ->select('recette.*')
                ->where(function ($query) use ($get) {
                    $query->where('label', 'like', '%' . $get . '%')
                        ->orWhere('type', 'like', '%' . $get . '%')
                        ->orWhere('description', 'like', '%' . $get . '%');
                })->get();
            foreach ($proposedRecettesByLabel as $item) {
                array_push($response, (object)array('favoris' => '0', 'favorisId' => '0', 'recette' => $item));
            }
        } else {
            $userFavoris = UserFavoris::whereIdUser($id_User)->get();
            foreach ($recettes as $recette) {
                if (count($userFavoris) > 0) {
                    if (($id_Favoris = $this->exist_favoris($userFavoris, $recette->id_Recette)) > 0) {
                        array_push($response, (object)array('favoris' => 1, 'favorisId' => $id_Favoris, 'recette' => $recette));
                    } else if (!$this->exist($response, $recette)) {
                        array_push($response, (object)array('favoris' => 0, 'favorisId' => 0, 'recette' => $recette));
                    }
                } else {
                    array_push($response, (object)array('favoris' => 0, 'favorisId' => 0, 'recette' => $recette));
                }
            }
            $proposedRecettes = ProposedRecette::where('id_User', '!=', $id_User)
                ->whereValid(1)
                ->join('recette', 'recette.id_Proposed', '=', 'proposed_recette.id_Proposed')
                ->select('recette.*')
                ->where(function ($query) use ($get) {
                    $query->where('label', 'like', '%' . $get . '%')
                        ->orWhere('type', 'like', '%' . $get . '%')
                        ->orWhere('description', 'like', '%' . $get . '%');
                })->get();
            foreach ($proposedRecettes as $recette) {
                if (count($userFavoris) > 0) {
                    if (($id_Favoris = $this->exist_favoris($userFavoris, $recette->id_Recette)) > 0) {
                        array_push($response, (object)array('favoris' => 1, 'favorisId' => $id_Favoris, 'recette' => $recette));
                    } else if (!$this->exist($response, $recette)) {
                        array_push($response, (object)array('favoris' => 0, 'favorisId' => 0, 'recette' => $recette));
                    }
                } else {
                    array_push($response, (object)array('recette' => $recette, 'favoris' => 0, 'favorisId' => 0));
                }
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