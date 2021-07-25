<?php

namespace App\Library;

use Illuminate\Support\Facades\Log;

class YoutubeCurl
{
    const URL = "https://www.googleapis.com/youtube/v3/";

    public static function exec_get($type, $params)
    {
        $url = self::URL . $type;

        $key = env('YOUTUBE_API_KEY');
        $params['key'] = $key;

        $get_str = [];
        foreach($params as $key => $val){
            $get_str[] = $key.'='.$val;
        }
        $url = $url . '?' . implode('&', $get_str);

        $result = Curl::exec_get($url);
        // Log::debug($result);

        return $result;
    }

    public static function video_category()
    {
        $type = "videoCategories";
        $params = [
            'part'       => 'snippet',
            'regionCode' => 'HK',
        ];
        $result = (array)YoutubeCurl::exec_get($type, $params);
        if($result){
            if(isset($result['items'])){
                $data = [];
                foreach($result['items'] as $idx => $item){
                    $id   = $item['id'];
                    $temp = [];

                    $temp['title'] = $item['snippet']['title'];
                    $temp['id']    = $item['id'];
                    $data[$id] = $temp;
                }
            }
        }
        return [
            'data' => $data,
        ];
    }

    public static function search($pageToken = null)
    {
        $type = "search";
        $params = [
            'part'            => 'snippet',
            'maxResults'      => 100,
            'order'           => 'viewCount',
            'publishedAfter'  => '2021-01-01T00:00:00Z',
            'publishedBefore' => '2021-07-31T00:00:00Z',
            'type'            => 'video',
            'videoCaption'    => 'any',
            'videoCategoryId' => '10',
            'regionCode'      => 'HK',
            'location'        => '22.302711,114.177216',
            'locationRadius'  => '20km',
        ];
        if($pageToken != null){
            $params['pageToken'] = $pageToken;
        }
        $result = (array) static::exec_get($type, $params);
        $data = [];
        $next = "";
        $prev = "";
        if($result){
            if(isset($result['prevPageToken'])) $prev = '/search/'.$result['prevPageToken'];
            if(isset($result['nextPageToken'])) $next = '/search/'.$result['nextPageToken'];
            foreach($result['items'] as $idx => $item){
                $id = $item['id']['videoId'];
                $temp = [];
                $temp['thumbnail'] = $item['snippet']['thumbnails']['high'];
                $temp['order'] = $idx + 1;
                $temp['videoId'] = $item['id']['videoId'];
                $temp['url'] = 'https://www.youtube.com/watch?v='.$item['id']['videoId'];
                $snippet = [
                    'title',
                    // 'publishedAt',
                    'channelId',
                    'channelTitle',
                    'description',
                ];
                $temp['publishedAt'] = date('Y-m-d H:i:s', strtotime($item['snippet']['publishedAt']));
                foreach($snippet as $s){
                    $value = $item['snippet'][$s];
                    $temp[$s] = $value;
                }
                $data[$id] = $temp;
            }
        }

        return [
            'data' => $data,
            'next' => $next,
            'prev' => $prev,
        ];
    }

    public static function videos($pageToken = null)
    {
        $type = "videos";
        $params = [
            'part'            => 'snippet,contentDetails,statistics',
            'chart'           => 'mostPopular',
            'maxResults'      => 50,
            'videoCategoryId' => '10',
            'regionCode'      => 'HK',
        ];
        if($pageToken != null){
            $params['pageToken'] = $pageToken;
        }
        $result = (array) static::exec_get($type, $params);
        $data = [];
        $next = "";
        $prev = "";
        $channels = [];
        if($result){
            if(isset($result['prevPageToken'])) $prev = '/search/'.$result['prevPageToken'];
            if(isset($result['nextPageToken'])) $next = '/search/'.$result['nextPageToken'];
            if(isset($result['items'])){
                foreach($result['items'] as $idx => $item){
                    $id = $idx + 1;
                    $temp = [];
                    $temp['thumbnail'] = $item['snippet']['thumbnails']['high'];
                    $temp['viewCount'] = number_format($item['statistics']['viewCount']);
                    $temp['videoId'] = $item['id'];
                    $temp['url'] = 'https://www.youtube.com/watch?v='.$item['id'];
                    $snippet = [
                        'title',
                        // 'publishedAt',
                        'channelId',
                        'channelTitle',
                        'description',
                    ];
                    $temp['publishedAt'] = date('Y-m-d H:i:s', strtotime($item['snippet']['publishedAt']));
                    foreach($snippet as $s){
                        $value = $item['snippet'][$s];
                        $temp[$s] = $value;
                    }
                    $channels[] = $item['snippet']['channelId'];



                    $data[$id] = $temp;
                }
            }
        }
        // foreach($channels as $idx => $ch){
        //     $channels[$idx] = "id[]=".urlencode($ch);
        // }
        $channelUrl = "/channels/".implode(',', $channels);
        return [
            'data'       => $data,
            'next'       => $next,
            'prev'       => $prev,
            'channelUrl' => $channelUrl,
        ];
    }

    public static function channels($id, $pageToken = null)
    {
        $type = "channels";
        $params = [
            'part'       => 'snippet,contentDetails,statistics',
            'maxResults' => 50,
            'id'         => implode(',', $id),

            // 'chart'           => 'mostPopular',
            // 'videoCategoryId' => '10',
            // 'regionCode'      => 'HK',
        ];
        if($pageToken != null){
            $params['pageToken'] = $pageToken;
        }
        $result = (array) static::exec_get($type, $params);
        $data = [];
        $next = "";
        $prev = "";
        if($result){
            if(isset($result['prevPageToken'])) $prev = '/search/'.$result['prevPageToken'];
            if(isset($result['nextPageToken'])) $next = '/search/'.$result['nextPageToken'];
            if(isset($result['items'])){
                foreach($result['items'] as $idx => $item){
                    $id = $idx + 1;
                    $temp = [];
                    $temp['thumbnail'] = $item['snippet']['thumbnails']['high'];
                    $temp['viewCount'] = number_format($item['statistics']['viewCount']);
                    $temp['channelId'] = $item['id'];
                    $temp['url'] = 'https://www.youtube.com/channel/'.$item['id'];
                    $snippet = [
                        'title',
                        'publishedAt',
                        // 'channelId',
                        // 'channelTitle',
                        'description',
                    ];
                    $temp['publishedAt'] = date('Y-m-d H:i:s', strtotime($item['snippet']['publishedAt']));
                    foreach($snippet as $s){
                        $value = $item['snippet'][$s];
                        $temp[$s] = $value;
                    }




                    $data[$id] = $temp;
                }
            }
        }

        return [
            'data' => $data,
            'next' => $next,
            'prev' => $prev,
        ];
    }
}
