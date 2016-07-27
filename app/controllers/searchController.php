<?php 

namespace Griff;

use \Symfony\Component\HttpFoundation\Request;

class SearchController extends CoreController
{

    public function results(Request $request, Application $app) {

        $searchTerm = $request->query->get('term');

        $spotifyResults = json_decode(Search::spotify($searchTerm)->getBody());

        return $app['twig']->render('searchResults.html.twig', [
            'albums'  => $spotifyResults->albums->items,
            'artists' => $spotifyResults->artists->items,
            'tracks'  => $spotifyResults->tracks->items
        ]);
    }

}
