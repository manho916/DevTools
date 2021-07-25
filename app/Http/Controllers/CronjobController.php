<?php

namespace App\Http\Controllers;

use App\Library\YoutubeCurl;
use App\Models\Video_category;
use Illuminate\Http\Request;

class CronjobController extends Controller
{
    public function get_video_category()
    {
        $params = YoutubeCurl::video_category();
        if($params && isset($params['data'])){
            foreach($params['data'] as $data){
                $insert = [
                    'title' => $data['title'],
                    'category_id' => $data['id'],
                ];
                Video_category::updateOrCreate($insert);
            }
        }
    }
}
