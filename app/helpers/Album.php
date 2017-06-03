<?php

namespace Griff;

use \GuzzleHttp\Client as GuzzleClient;

class Album {

    public static function getTracks($albumID, $country = 'GB') {

        $client = new GuzzleClient;

        $result = $client->request('GET', 'https://api.spotify.com/v1/albums/'.$albumID.'/tracks', [
            'query' => [
                'market' => $country
            ],
            'headers' => [
              'Authorization' => 'Bearer '.Spotify::getAccessToken()
            ]
        ]);

        return json_decode($result->getBody());

    }

    public static function getInfo($albumID, $country = 'GB') {

        $client = new GuzzleClient;

        $result = $client->request('GET', 'https://api.spotify.com/v1/albums/'.$albumID, [
            'query' => [
                'market' => $country
            ],
            'headers' => [
              'Authorization' => 'Bearer '.Spotify::getAccessToken()
            ]
        ]);

        return json_decode($result->getBody());

    }

}