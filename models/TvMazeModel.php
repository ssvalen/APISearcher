<?php 

class TvMazeModel{

    public function executeRequestTvMaze($show = '')
    {
        $ch = curl_init();

        $url = "https://api.tvmaze.com/search/shows?q=". $show;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($e = curl_error($ch)) return 500;
        else return json_decode($response, true);

    }

    public function searchShowTvMaze($search = '')
    {
        $response = $this->executeRequestTvMaze($search);
        if($response === 500) return $response;
        else return (!empty($response)) ? $response : 404;
    }

}

?>