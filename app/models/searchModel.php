<?php 

namespace Griff;

use \GuzzleHttp\Client as GuzzleClient;

class SearchModel extends CoreModel
{
    public function formatSearchTerm($term){

        $stripWords = ['the', 'a'];

        $term = explode(' ', $term);

        $term = array_udiff($term, $stripWords, 'strcasecmp');

        $term = implode(' ', $term);

        return trim($term);
    }
}
