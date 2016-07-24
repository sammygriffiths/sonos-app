<?php 

namespace Griff;

use Symfony\Component\HttpFoundation\Request;

class DashboardController extends CoreController
{

    public function index(Request $request, Application $app) {

        return $app['twig']->render('dashboard.html.twig');
    }

}
