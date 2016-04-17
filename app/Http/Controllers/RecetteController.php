<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Recette;
use Input;
class RecetteController extends Controller
{
    public function index(){
    	return view('recetteForm')->with('response',"");
    }

	public function store(Request $request){
		if (!$request->has([
            'label',
            'description',
            'type'
        ])
        ) {
        	return view('recetteForm')->with('response','completez les champs');
		}else{
		$newRecette=new Recette();
		$newRecette->label=$request->input('label');
		$newRecette->description=$request->input('description');
		$newRecette->type=$request->input('type');
		$newRecette->save();
        $recettes=Recette::all();
        
        
        
		return view('recetteView')->with('recettes' , $recettes)/*->with('response','recette ajoutée :) !')*/;
        }
    }
    public function getRecette($id_Recette = null){
    	$recettes=Recette::all();
        
        
        return view('recetteView')->with('recettes' , $recettes);
    	
    }

    public function storeParserRecipe(Request $request){
        $newRecette=new Recette();
        $newRecette->label=$request->input('label');
        $newRecette->description=$request->input('description');
        $newRecette->type="";
        $newRecette->save();

        return redirect('/');
    }
    public function getUpdate($id){
        
        $recette=Recette::find($id);
        return view('recetteUpdate')->with('recette' , $recette);
    }
    public function delete($id){
        Recette::find($id)->delete();
        
        $recettes=Recette::all();
        return redirect()->action('RecetteController@getRecette', ['recettes' => $recettes]);
       
    }

}
