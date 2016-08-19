<?php 

namespace Griff;

use \Symfony\Component\HttpFoundation\Request;

class ArtistController extends CoreController
{

    public function __construct(Request $request, Application &$app, $artistID) {
        $this->request = $request;
        $this->app = $app;
        $this->artistID = $artistID;
        $this->model = new ArtistModel($artistID);
    }

    public function index() {
        $artistInfo = $this->model->getAristInfo();
        $topTracks  = $this->model->getTopTracks();
        $albums     = $this->model->getAlbums();

        return $this->app['twig']->render('artist.html.twig', [
            'artistInfo' => $artistInfo,
            'topTracks'  => $topTracks,
            'albums'     => $albums
        ]);
    }

}
