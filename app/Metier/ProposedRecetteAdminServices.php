<?php

namespace App\Metier;

use App\Model\ProposedRecette;

class ProposedRecetteAdminServices
{

    public function getAddProposed()
    {
        return ProposedRecette::whereValid(0)
            ->join('recette', 'recette.id_Proposed', '=', 'proposed_recette.id_Proposed')
            ->select('recette.*')
            ->get();
    }

    public function validate($id_Proposed)
    {
        $propsedRecette = ProposedRecette::find($id_Proposed);
        if ($propsedRecette == null) {
            return response()->json(['response' => 'proposition not found'], 404);
        } else {
            $propsedRecette->valid = 1;
            $propsedRecette->save();
            return response()->json(['response' => $propsedRecette], 200);
        }
    }

    public function refuser($id_Proposed)
    {
        $propsedRecette = ProposedRecette::find($id_Proposed);
        if ($propsedRecette == null) {
            return response()->json(['response' => 'proposition not found'], 404);
        } else {
            $propsedRecette->valid = 2;
            $propsedRecette->save();
            return response()->json(['response' => $propsedRecette], 200);
        }
    }
}