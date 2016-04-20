<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Metier\RecetteService;
use App\Model\Recette;
use Illuminate\Http\Request;
use Input;

class RecetteController extends Controller
{
    protected $recetteService;

    public function __construct(RecetteService $recetteService)
    {
        $this->recetteService = $recetteService;
    }

    public function index()
    {
        return view('recetteForm')->with('response', "");
    }

    public function store(Request $request)
    {
        if (!$request->has([
            'label',
            'description',
            'type'
        ])
        ) {
            return view('recetteForm')->with('response', 'completez les champs');
        } else {
            $newRecette = new Recette();
            $newRecette->label = $request->input('label');
            $newRecette->description = $request->input('description');
            $newRecette->type = $request->input('type');
            $newRecette->save();
            return redirect('/recette');
        }
    }

    public function getRecette($id_Recette = null)
    {
        if ($id_Recette != null) {
            $recette = $this->recetteService->getRecette($id_Recette);
            return $recette;
        } else {
            $recettes = Recette::all();
            return view('recetteView')->with('recettes', $recettes);
        }
    }

    public function storeParserRecipe(Request $request)
    {
        $newRecette = new Recette();
        $newRecette->label = $request->input('label');
        $newRecette->description = $request->input('description');
        $newRecette->type = "";
        $newRecette->save();

        return redirect('/recette');
    }

    public function getUpdate($id_Recette = null)
    {
        if ($id_Recette != null) {
            $recette = $this->recetteService->getRecette($id_Recette);
            return view('recetteUpdate')->with('recette', $recette);
        }
    }

    public function Update($id_Recette = null, Request $request)
    {
        if ($id_Recette != null) {
            $this->recetteService->updateRecette($id_Recette, $request);
        }
        return redirect('/recette');
    }

    public function delete($id_Recette = null)
    {
        $this->recetteService->deleteRecette($id_Recette);
        return redirect('/recette');
    }

}
