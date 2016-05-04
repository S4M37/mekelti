<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Feeds;

class FeedController extends Controller
{
    //

    public function index($link = null)
    {


        $url = "";
        switch ($link) {
            case 1:
                $url="http://www.recettes-cuisine-afrique.info/feed/";
                break;
            case 2:
                $url="http://patisserie-maison2.webnode.fr/rss/all.xml";
                break;
            case 3:
                $url="http://www.recette-dessert.com/rss.xml";
                break;
            case 4:
                $url="http://cuisine-facile.com/rss_news.xml";
                break;
            case 5:
                $url="http://feeds.feedburner.com/Epicurienbe?format=xml";
                break;
            case 6:
                $url="http://www.cuisine-et-vous.com/recettes/spip.php?page=backend";
                break;
            case 7:
                $url="http://www.recettesdecuisine.tv/rss-cuisine.php";
                break;
            case 8:
                $url="http://www.odelices.com/feed/";
                break;
            case 9:
                $url="http://www.cuisinedesbasques.com/feed/";
                break;
        }
        $feed = Feeds::make($url);

        $data = array(
            'title' => $feed->get_title(),
            'permalink' => $feed->get_permalink(),
            'items' => $feed->get_items(),
        );

        return view('feedView')->with($data);

    }

    public function links()
    {
        return view('linkparser');
    }

}