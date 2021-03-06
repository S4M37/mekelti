<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Metier\RecetteService;
use App\Model\ProposedRecette;
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
            $image = $request->file('image');
            $chemin = config('images.path');
            $extension = $image->getClientOriginalExtension();
            do {
                $nom = str_random(10) . '.' . $extension;
            } while (file_exists($chemin . '/' . $nom));
            $image->move($chemin, $nom);
            $newRecette->img = 'http://192.168.1.4' . $request->getBaseUrl() . '/' . $chemin . '/' . $nom;
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
            $recettes = Recette::orderBy('id_Recette', 'desc')->whereIdProposed(0)->get();
            $propsedRecettes = ProposedRecette::whereValid(1)
                ->join('recette', 'recette.id_Proposed', '=', 'proposed_recette.id_Proposed')
                ->select('recette.*')->get();
            return view('recetteView')->with('recettes', $recettes)->with('proposedRecettes', $propsedRecettes);
        }
    }

    public function storeParserRecipe(Request $request)
    {
        $description = $request->input('description');
        $newRecette = new Recette();
        $newRecette->label = $request->input('label');
        $newRecette->description = $this->getDescription($description);
        $newRecette->type = "";
        $newRecette->img = $this->getSrc($description);
        $newRecette->link = $request->input('link');
        $newRecette->save();

        return redirect('/recette');
    }

    public function getDescription($str = "")
    {

        $text = $str;
        if ((preg_match('/</', $text)) == 0)
            return $text;
        $document = new \DOMDocument();
        $document->loadHTML($text);
        if (preg_match("/^<img/", $text)) {


            return $data = substr($text, strpos($text, ">") + 1, strlen($text) - (strpos($text, ">") + 1));
        } else {
            $texts = array();
            $datas = preg_split(preg_quote("/</"), $text);
            array_push($texts, $datas[0]);
            for ($i = 1; $i < count($datas); $i++) {
                $tmp = substr($datas[$i], strpos($datas[$i], ">") + 1, strlen($datas[$i]) - (strpos($datas[$i], ">") + 1));
                array_push($texts, $tmp);
            }
            $str = "";
            foreach ($texts as $txt) {
                $str .= $txt;
            }
            return $str;
        }


    }

    public function getSrc($str = "")
    {
        $urls = array();
        $dom = new \DOMDocument();
        $dom->loadHTML($str);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $image) {
            $url = $image->getAttribute('src');
            array_push($urls, $url);

        }
        return $urls[0];
        //3-6-10-11 only images

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
