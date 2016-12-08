<?php

namespace Griff;

use \GuzzleHttp\Client as GuzzleClient;

class Search {

    public static function spotify($searchTerm, $types = ['album', 'artist', 'track']) {

        $client = new GuzzleClient;

        $types = implode(',', $types);

        $result = $client->request('GET', 'https://api.spotify.com/v1/search', [
            'query' => [
                'q'    => '"'.$searchTerm.'" OR "'.str_replace(' ', '', $searchTerm).'"',
                'type' => $types
            ]
        ]);

        return json_decode($result->getBody());

    }

}