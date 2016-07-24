<?php 

namespace Griff;

use Symfony\Component\HttpFoundation\Request;

class CoreController
{
    protected $model;

    public function __construct() {
        $this->setModel();
    }

    private function setModel() {
        $model = str_replace('Controller', 'Model', get_class($this));
        $this->model = new $model;
    }
}
