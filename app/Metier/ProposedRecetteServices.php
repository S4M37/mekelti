<?php
namespace App\Metier;

use App\Model\ProposedRecette;
use App\Model\Recette;
use App\Model\User;
use Illuminate\Support\Facades\Input;

class ProposedRecetteServices
{

    public function getAllProposed($id_user)
    {
        $user = User::find($id_user);
        if ($user != null) {
            $proposedRecettes = ProposedRecette::whereIdUser($id_user)
                ->join('recette', 'recette.id_Proposed', '=', 'proposed_recette.id_Proposed')->get();
            $response = array();
            foreach ($proposedRecettes as $proposedRecette) {
                $recette = Recette::find($proposedRecette->id_Recette);
                array_push($response, (object)array('valid' => $proposedRecette->valid,
                    'id_Proposed' => $proposedRecette->id_Proposed, 'recette' => $recette));
            }
            return response()->json(['response' => $response], 200);
        } else {
            return response()->json(['response' => 'user not found'], 404);
        }
    }

    public function store($id_user, $request)
    {
        $user = User::find($id_user);
        if ($user != null) {
            $proposedRecette = new ProposedRecette();
            $proposedRecette->id_User = $id_user;
            $proposedRecette->valid = 0;
            $proposedRecette->save();

            $recette = new Recette();
            $recette->label = Input::get('label');
            $recette->description = Input::get('description');
            $recette->type = Input::get('type');
            $recette->id_Proposed = $proposedRecette->id_Proposed;

            $chemin = config('images.path');
            do {
                $nom = str_random(10) . '.png';
            } while (file_exists($chemin . '/' . $nom));

            $this->base64_to_jpeg(Input::get('image'), $chemin . '/' . $nom);

            $recette->img = 'http://192.168.43.26' . $request->getBaseUrl() . '/' . $chemin . '/' . $nom;

            $recette->save();

            return response()->json(['response' => (object)array('valid' => 0, 'recette' => $recette)], 200);
        } else {
            return response()->json(['response' => 'user not found'], 404);
        }
    }

    function base64_to_jpeg($base64_string, $output_file)
    {
        $ifp = fopen($output_file, "wb");
        // $data = explode(',', $base64_string);
        $data = $base64_string;
        fwrite($ifp, base64_decode($data));
        fclose($ifp);

        return $output_file;
    }

    public function delete($id_Proposed)
    {
        $propsedRecette = ProposedRecette::find($id_Proposed);
        if ($propsedRecette == null) {
            return response()->json(['response' => 'proposition not found'], 404);
        } else {
            $recette = Recette::whereIdProposed($id_Proposed)->first();
            $recette->delete();
            $propsedRecette->delete();
            return response()->json(['response' => 'proposition deleted'], 200);
        }
    }
}