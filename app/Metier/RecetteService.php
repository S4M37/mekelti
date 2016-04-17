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
}