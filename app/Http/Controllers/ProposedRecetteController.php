<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Metier\ProposedRecetteServices;
use Illuminate\Http\Request;

class ProposedRecetteController extends Controller
{
    protected $proposedRecetteServices;

    public function __construct(ProposedRecetteServices $proposedRecetteServices)
    {
        $this->proposedRecetteServices = $proposedRecetteServices;
    }

    public function getProposed($id_user, $id_Propsed = null)
    {
        if ($id_Propsed == null) {
            return $this->proposedRecetteServices->getAllProposed($id_user);
        }
        return $this->proposedRecetteServices->getProposed($id_user, $id_Propsed);
    }

    public function proposeRecette($id_User, Request $request)
    {
        return $this->proposedRecetteServices->store($id_User, $request);
    }

    public function delete($id_User, $id_Proposed)
    {
        return $this->proposedRecetteServices->delete($id_Proposed);
    }
}
