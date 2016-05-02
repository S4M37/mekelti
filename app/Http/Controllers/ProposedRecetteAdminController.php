<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Metier\ProposedRecetteAdminServices;

class ProposedRecetteAdminController extends Controller
{
    protected $proposedRecetteAdminServices;

    public function __construct(ProposedRecetteAdminServices $proposedRecetteAdmin)
    {
        $this->proposedRecetteAdminServices = $proposedRecetteAdmin;
    }

    public function getAllProposed()
    {
        $proposedRecettes = $this->proposedRecetteAdminServices->getAddProposed();
        return view('proposedRecetteView')->with('proposedRecettes', $proposedRecettes);
    }

    public function validateProposition($id_Propsed)
    {
        $this->proposedRecetteAdminServices->validate($id_Propsed);
        return redirect('/proposition');
    }

    public function refuser($id_Proposed)
    {
        $this->proposedRecetteAdminServices->refuser($id_Proposed);
        return redirect('/proposition');
    }

}
