<?php 

class ITunesController {
    private $model;

    public function __construct(){
      $this->model = new ITunesModel();
    }
    public function searchItunes($query = '', $media = '')
    {
      return $this->model->searchItunes($query, $media);

    }
}

?>