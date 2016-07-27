<?php 

namespace Griff;

use \Symfony\Component\HttpFoundation\Request;

class QueueController extends CoreController
{

    public function index(Request $request, Application $app) {
        $this->model->addSpotifyTrackToQueue('2LZkVdFGhwjauryHLWMkLX');
    }

}
