<?php 

namespace Griff;

use \Symfony\Component\HttpFoundation\Request;

class CoreController
{
    protected $model;
    protected $request;
    protected $app;

    public function __construct(Request $request, Application &$app) {
        $this->setModel();
        $this->request = $request;
        $this->app = $app;
    }

    private function setModel() {
        $model = str_replace('Controller', 'Model', get_class($this));
        $this->model = new $model;
    }
}
