<?php 

namespace Griff;

use \GuzzleHttp\Client as GuzzleClient;
use \SQLite3;
use \Doctrine\Common\Cache\FilesystemCache as Cache;
use \duncan3dc\Sonos\Network as Sonos;
use \duncan3dc\Sonos\Tracks\Spotify;

class QueueModel extends CoreModel
{
    private $db;
    private $mostRecent;
    private $sonosCacheFile;
    private $sonos;
    private $sonosController;
    private $queue;
    private $nowPlaying;

    public function __construct() {
        $this->db = new SQLite3(__DIR__.'/../data/latest_track.db');
        $this->sonosCacheFile = new Cache(__DIR__."/../cache/sonos");
        $this->sonos = new Sonos($this->sonosCacheFile);
        $this->sonosController = $this->sonos->getControllerByRoom('Media Room');
        $this->queue = $this->sonosController->getQueue();
        $this->nowPlaying = $this->sonosController->getStateDetails();
        $this->mostRecent = $this->getMostRecent();
    }

    private function getMostRecent() {
        $results = $this->db->query('SELECT * FROM latest_track LIMIT 1');
        return $results->fetchArray(SQLITE3_ASSOC);
    }

    public function addSpotifyTrackToQueue($spotifyID) {
        echo "<pre>";
        // var_dump($this->queue->getTracks());
        var_dump($this->nowPlaying);
        exit;
        $track = new \duncan3dc\Sonos\Tracks\Spotify($spotifyID);

        if (
            !$this->mostRecent || 
            $this->mostRecent['queue_position'] <= $this->nowPlaying->queueNumber ||
            $this->queue->count() <= 1
        ) {
            $queuePosition = (int) $this->nowPlaying->queueNumber + 1;
        } else {
            $queuePosition = (int) $this->mostRecent['queue_position'] + 1;
        }

        $this->queue->addTrack($track, $queuePosition);
        $this->db->query('DELETE FROM latest_track');
        $this->db->query('INSERT INTO latest_track (queue_position, uri) VALUES ('.$queuePosition.', "")');

    }
    
}
