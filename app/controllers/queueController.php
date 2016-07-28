<?php 

namespace Griff;

use \Symfony\Component\HttpFoundation\Request;

class QueueController extends CoreController
{

    public function index(Request $request, Application $app) {
        $this->model->addSpotifyTrack('7yCPwWs66K8Ba5lFuU2bcx');
    }

    public function clear(Request $request, Application $app) {
        $this->model->clear();
    }

    public function resetMostRecent(Request $request, Application $app) {
        $this->model->resetMostRecent();
    }

    public function add(Request $request, Application $app) {
        $type = ucfirst($request->query->get('type'));
        $id   = $request->query->get('id');

        $modelFunction = 'add'.$type.'Track';

        return $this->model->$modelFunction($id);
    }

}
