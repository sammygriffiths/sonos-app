<?php 

namespace Griff;

use \GuzzleHttp\Client as GuzzleClient;

class ArtistModel extends CoreModel
{
    private $client;
    private $artistID;

    public function __construct($artistID) {
        $this->artistID = $artistID;
        $this->client   = new GuzzleClient;
    }

    public function getAristInfo() {
        $artistInfo = $this->client->request('GET', 'https://api.spotify.com/v1/artists/'.$this->artistID.'/')->getBody();

        return json_decode($artistInfo);
    }

    public function getTopTracks($country = 'GB') {
        $topTracks = $this->client->request('GET', 'https://api.spotify.com/v1/artists/'.$this->artistID.'/top-tracks?country='.$country)->getBody();

        return json_decode($topTracks);
    }

    public function getAlbums() {
        $albums = $this->client->request('GET', 'https://api.spotify.com/v1/artists/'.$this->artistID.'/albums/',  [
            'query' => [
                'market' => 'GB',
            ]
        ])->getBody();
        $albums = json_decode($albums);

        foreach ($albums->items as &$album) {
            $album = Album::getInfo($album->id);
        }

        return $albums;
    }
}
