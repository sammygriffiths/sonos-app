<?php 

namespace Griff;

use \Symfony\Component\HttpFoundation\Request;

class QueueController extends CoreController
{

    public function clear(Request $request, Application $app) {
        return json_encode([
            'success' => $this->model->clear()
        ]);
    }

    public function resetMostRecent(Request $request, Application $app) {
        return json_encode([
            'success' => $this->model->resetMostRecent()
        ]);
    }

    public function add(Request $request, Application $app) {
        $type = ucfirst($request->query->get('type'));
        $id   = $request->query->get('id');

        $modelFunction = 'add'.$type.'Track';

        return json_encode([
            'success' => $this->model->$modelFunction($id)
        ]);
    }

}
