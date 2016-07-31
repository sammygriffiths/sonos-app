<?php 

namespace Griff;

use \Symfony\Component\HttpFoundation\Request;

class SearchController extends CoreController
{

    public function results() {

        $searchTerm = $this->request->query->get('term');

        $spotifyResults = Search::spotify($searchTerm, ['track', 'artist']);

        return $this->app['twig']->render('searchResults.html.twig', [
            'artists' => $spotifyResults->artists->items,
            'tracks'  => $spotifyResults->tracks->items
        ]);
    }

}
