<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Metier\SearchServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    protected $searchServices;

    public function __construct(SearchServices $searchServices)
    {
        $this->searchServices = $searchServices;
    }

    public function searchAutoCompelte(Request $request)
    {
        return $this->searchServices->searchByAll(Input::get('label'), Input::get('id_User'));
    }
}
