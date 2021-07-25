<?php
namespace App\Library;

Class Curl
{
    public static function exec_get($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);

        curl_close($ch);

        return json_decode($output, true);
    }

    public static function exec_post($url, $params)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

        $output = curl_exec($ch);

        curl_close($ch);

        return json_decode($output, true);
    }
}
