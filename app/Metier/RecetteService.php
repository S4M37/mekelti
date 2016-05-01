<?php

namespace App\Metier;

use App\Model\Recette;

class RecetteService
{
    function getRecette($id_Recette)
    {
        return Recette::find($id_Recette);
    }

    function deleteRecette($id_Recette)
    {
        Recette::find($id_Recette)->delete();
    }

    function updateRecette($id_Recette, $request)
    {
        $updatedRecette = Recette::find($id_Recette);
        $updatedRecette->label = $request->input('label');
        $updatedRecette->description = $request->input('description');
        // $updatedRecette->img = $request->input('description');
        $updatedRecette->type = $request->input("type");
        $updatedRecette->save();
    }

    function getDescription($desc)
    {
        return substr($desc, strpos('>', $desc));
    }
}