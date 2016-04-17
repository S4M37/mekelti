<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Feeds;

class FeedController extends Controller
{
    //

    public function index($link = null){


      $url="";
      switch($link){
          case 1:
          $url="http://www.recettes-cuisine-afrique.info/feed/";
          break;
          case 2:
          $url="http://www.gourmandines.fr/rss.xml";
          break;
          case 3:
          $url="http://www.recette-dessert.com/rss.xml";
          break;
      }
    	$feed = Feeds::make($url);

    	$data = array(
      		'title'     => $feed->get_title(),
      		'permalink' => $feed->get_permalink(),
      		'items'     => $feed->get_items(),
    	);

    	return view('feedView')->with($data);
  
    }

    public function links(){
        return view('linkparser');
  }

 }