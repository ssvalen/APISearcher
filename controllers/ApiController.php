<?php 



class ApiController {



  public $output = [];
  public $tvMaze = 404, $iTunes = 404, $nameList = 404;

  public function error500()

  {

    http_response_code(500);
    $this->output['message'] = '500 Internal Server Error';

  }

  public function error400()

  {

    http_response_code(400);
    $this->output['message'] = '400 Bad Request: Request must include search parameter!';

  }

  public function error404()

  {

    http_response_code(404);
    $this->output['message'] = 'No matches were found.';

  }

  public function sendResponse()

  {
   
    header_remove('X-Powered-By');
    header_remove('Server');
    header('Content-type: application/json');
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header("Content-Security-Policy: default-src 'none'");

    echo json_encode($this->output);

    die();

  }

  }



?>