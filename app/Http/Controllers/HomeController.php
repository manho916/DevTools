<?php

namespace App\Http\Controllers;

use App\Library\Curl;
use App\Library\youtube as LibraryYoutube;
use App\Library\YoutubeCurl;
use DateTime;
use DateTimeZone;
use Google_Client;
use Illuminate\Http\Request;
use Google\Service\YouTube;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $oauth_id = "598368097094-5hvq8i7s3olh0lq3e1cclb9m5j2pkda1.apps.googleusercontent.com";
        $oauth_key = "vv3Ltghh_ZbTGhRNMIOgAR9G";
        $data = [];

        return view('home', compact('data'));
    }

    public function video_category()
    {
        $data = YoutubeCurl::video_category();

        return view('vc', $data);
    }

    public function search($pageToken = null)
    {
        $data = YoutubeCurl::search($pageToken);
        // dd($data);

        return view('search', $data);
    }

    public function videos($pageToken = null)
    {
        $data = YoutubeCurl::videos($pageToken);

        return view('video', $data);
    }

    public function channels($id = '')
    {
        $id = explode(',', $id);
        $data = YoutubeCurl::channels($id);

        return view('channel', $data);
    }
}
