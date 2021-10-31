<?php 

class TvMazeController {
    private $model;

    public function __construct(){
      $this->model = new TvMazeModel();
    }
    public function searchShowTvMaze($query = '')
    {
      return $this->model->searchShowTvMaze($query);

    }
    
}

?>