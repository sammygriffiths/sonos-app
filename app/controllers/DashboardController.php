<?php 

namespace Griff;

use \Symfony\Component\HttpFoundation\Request;

class DashboardController extends CoreController
{

    public function index() {

        // $cache = new \Doctrine\Common\Cache\FilesystemCache(__DIR__."/../cache/sonos");
        // $sonos = new \duncan3dc\Sonos\Network($cache);
        // $controller = $sonos->getControllerByRoom('Media Room');
        // $track = new \duncan3dc\Sonos\Tracks\Spotify('7yCPwWs66K8Ba5lFuU2bcx');
        // echo "<pre>";
        // var_dump($track);
        // var_dump($controller->getStateDetails());
        // var_dump($controller->getQueue()->getTracks());
        // exit;
        // $controller->getQueue()->clear();
        // $controller->getQueue()->addTrack($track);
        // $controller->play();

        return $this->app['twig']->render('dashboard.html.twig');
    }

}
