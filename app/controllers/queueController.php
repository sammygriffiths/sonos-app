<?php 

namespace Griff;

use \Symfony\Component\HttpFoundation\JsonResponse;

class QueueController extends CoreController
{

    public function clear() {
        return new JsonResponse([
            'success' => $this->model->clear()
        ]);
    }

    public function resetMostRecent() {
        return new JsonResponse([
            'success' => $this->model->resetMostRecent()
        ]);
    }

    public function add() {
        $type = ucfirst($this->request->query->get('type'));
        $id   = $this->request->query->get('id');

        $modelFunction = 'add'.$type.'Track';

        return new JsonResponse([
            'success' => $this->model->$modelFunction($id)
        ]);
    }

}
