<?php 

namespace Griff;

class Application extends \Silex\Application
{

    public function __construct(array $values = array()) {
        parent::__construct($values);
    }
}
