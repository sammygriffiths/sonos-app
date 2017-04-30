<?php

namespace Griff;

use \GuzzleHttp\Client as GuzzleClient;

class Album {

    public static function getTracks($albumID, $country = 'GB') {

        $client = new GuzzleClient;

        $result = $client->request('GET', 'https://api.spotify.com/v1/albums/'.$albumID.'/tracks', [
            'query' => [
                'market' => $country
            ]
        ]);

        return json_decode($result->getBody());

    }

    public static function getInfo($albumID, $country = 'GB') {

        $client = new GuzzleClient;

        $result = $client->request('GET', 'https://api.spotify.com/v1/albums/'.$albumID, [
            'query' => [
                'market' => $country
            ]
        ]);

        return json_decode($result->getBody());

    }

}