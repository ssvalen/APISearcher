<?php 

class NameFinderController {
    private $model;

    public function __construct(){
      $this->model = new NameFinderModel();
    }
    public function getPersonName($name = '')
    {
      return $this->model->getPersonName($name);
    }
}

?>