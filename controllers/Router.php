<?php



class Router{

  public $router;

  public function __construct($route){

    $view = new ViewController();

    switch($route) {

        case 'home':

          $view->load_view('home');

        break;

        case 'api':

            
            $ApiController = new ApiController();

            // Verifica que el método HTTP sea de tipo GET
            if($_SERVER['REQUEST_METHOD'] === 'GET') {

              if(isset($_REQUEST['search'])) {

                if(!empty($_REQUEST['search'])) {

                  // Inicializar controladores

                  $TvMazeController = new TvMazeController();
                  $ITunesController = new ITunesController();
                  $NameFinderController = new NameFinderController();

                  // Codifica el criterio de búsqueda para su uso posteriormente
                  $search = urlencode($_REQUEST['search']);

                  // Comprueba si hay algún medio  definido, si no, configura "all" por defecto 
                  if(isset($_REQUEST['media'])) {

                    $mediaType = (!empty($_REQUEST['media']) && $_REQUEST['media'] === 'tvShow' || $_REQUEST['media'] === 'movie' || $_REQUEST['media'] === 'music' || $_REQUEST['media'] === 'name') ? $_REQUEST['media'] : 'all';

                  } else $mediaType = 'all';

                  /*

                    * Verifica el tipo de medio (mediaType), luego invoca las funciones desde los controladores y pasa los datos de búsquedad en la variable "$search" y el tipo de medio en la variable "$mediaType". 

                    * Las funciones pueden retornar los siguentes valores: int 404, int 500, Array con los resultados.


                    */


                  if($mediaType === 'movie' || $mediaType === 'music' || $mediaType === 'tvShow' || $mediaType === 'all') {

                    if($mediaType === 'tvShow' || $mediaType === 'all') 
                      $ApiController->tvMaze = $TvMazeController->searchShowTvMaze($search);

                    $ApiController->iTunes = $ITunesController->searchItunes($search, $mediaType);

                  } 

    

                  if($mediaType === 'name' || $mediaType === 'all') $ApiController->nameList = $NameFinderController->getPersonName($search);

                  /*

                    * Arrays que contendrán los resultados de búsqueda

                  */

                  $arr = [];
                  $movies = [];
                  $tvShows = [];
                  $music = [];

                  /*

                    * Verifica que la variable $tvMaze no esté vacía (404) y que no hayan erroes (500), de cumplir lo anterior itera y añade el "origen de la búsqueda" al array $row este array es agregado al array $tvshows.

                  */

                  if(!empty($ApiController->tvMaze) && $ApiController->tvMaze != 500 && $ApiController->tvMaze != 404) {

                    foreach ($ApiController->tvMaze as $key => $row) {

                      $row['searchSource'] = 'TvMaze';
                      array_push($tvShows, $row);

                    }

                  }

                  /*

    

                    * Verifica que la variable $itunes no esté vacía (404) y que no hayan errores (505), de cumplir lo anterior itera, agrega el "origen de búsqueda" y luego verifica si el objeto "kind" existe. Luego verifica si es una película, canción u otro. Dependiendo de su clasificación se añade a los siguientes arrays: $movies, $music o $tvShows.

    

                  */

                  if(!empty($ApiController->iTunes) && $ApiController->iTunes != 500 && $ApiController->iTunes != 404) {

                    foreach ($ApiController->iTunes['results'] as $key => $row) {

                      $row['searchSource'] = 'iTunes';

                      if(isset($row['kind']) && $row['kind'] === 'feature-movie') array_push($movies, $row);

                      else if(isset($row['kind']) && $row['kind'] === 'song') array_push($music, $row);

                      else {

                        if(isset($row['collectionType']) && $row['collectionType'] === 'TV Season') array_push($tvShows, $row);

                      }

                    }

                    

                  }

                  /*

                    * Para poder armar el JSON de salida, primero se verifica que los arrays: $tvShows, $movie, $music no estén vacios. Para la búsqueda de nombres se verifica que no está vacía la variable $nameList (404) y que no contenga errores (500). De cumplir lo anterior se agregan al array $arr.

                  */

                  if($mediaType === 'tvShow' || $mediaType === 'all') {

                    if(!empty($tvShows)) $arr['tvShows'] = $tvShows;

                  }

                  if($mediaType === 'movie' || $mediaType === 'all') {

                    if(!empty($movies)) $arr['movies'] = $movies;

                  }

                  if($mediaType === 'music' || $mediaType === 'all') {

                    if(!empty($music)) $arr['music'] = $music;

                  }

                  if($mediaType === 'name' || $mediaType === 'all') {

                    if($ApiController->nameList != 500 && $ApiController->nameList != 404) $arr['namesList'] = $ApiController->nameList;

                  }

                  /*

                    * Verifica si hay errores tipo 404 y 500. Para lanzar un error de estos TODAS las variables deben de tener el error. Si alguna variable no tiene ningún error no se lanzará ningún error HTTP y se agregará el array $arr al array $output para posteriormente ser enviado como respuesta.

                  */

                  if($ApiController->tvMaze === 500 && $ApiController->iTunes === 500 && $ApiController->nameList === 500) $ApiController->error500();

                  else if($ApiController->tvMaze === 404 && $ApiController->iTunes === 404 && $ApiController->nameList === 404) $ApiController->error404();

                  else {

    

                    // Agrega el tipo de medio solicitado al array de salida
                    $ApiController->output['mediaType'] = $mediaType;

                    // Agrega el array que contiene los resultados de búsqueda
                    $ApiController->output['searchResults'] = $arr;

                  }
              
                }

              } else $ApiController->error400();

            } else {

              http_response_code(405);
              header("Allow: GET");

              $ApiController->output['message'] = '405 HTTP Method Not Allowed';

            }

            // Se envía la respuesta a la petición solicitada
            $ApiController->sendResponse();

          break;

 

    }



  }

}

?>