<?php 

namespace Griff;

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

    public function __construct($roomName = 'Media Room') {
        $this->db = new SQLite3(__DIR__.'/../data/latest_track.db');
        $this->sonosCacheFile = new Cache(__DIR__."/../cache/sonos");
        $this->sonos = new Sonos($this->sonosCacheFile);
        $this->sonosController = $this->sonos->getControllerByRoom($roomName);
        $this->queue = $this->sonosController->getQueue();
        $this->nowPlaying = $this->sonosController->getStateDetails();
        $this->mostRecent = $this->getMostRecent();
    }

    private function getMostRecent() {
        $results = $this->db->query('SELECT * FROM latest_track LIMIT 1');
        return $results->fetchArray(SQLITE3_ASSOC);
    }

    public function resetMostRecent() {
        return $this->db->exec('DELETE FROM latest_track');
    }

    public function clear() {
        $this->queue->clear();
        return $this->resetMostRecent();
    }

    public function addSpotifyTrack($spotifyID) {
        $track = new Spotify($spotifyID);

        if (!$this->mostRecent || $this->mostRecent['queue_position'] <= $this->nowPlaying->queueNumber) {
            $nowPlayingPosition = $this->nowPlaying->queueNumber + 1; // Add 1, getting the queue number is 0 indexed, but adding to the queue isn't
            $queuePosition = $nowPlayingPosition + 1;
        } elseif ($this->queue->count() == 0) { 
            $queuePosition = 1;
        } else {
            $queuePosition = (int) $this->mostRecent['queue_position'] + 1;
        }

        $this->resetMostRecent();
        $this->db->query('INSERT INTO latest_track (queue_position, uri) VALUES ('.$queuePosition.', "")');
        return $this->queue->addTrack($track, $queuePosition);

    }
    
}
