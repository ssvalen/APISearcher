<?php 

class ITunesModel {

    public function executeRequestItunes($term = '', $media = '')
    {

        $ch = curl_init();

        $url = "https://itunes.apple.com/search?term=". $term. '&media='. $media . '&entity=';
        
        if($media === 'tvShow') $url.= 'tvSeason&attribute=tvSeasonTerm';
        else if($media === 'movie') $url.= 'movie&attribute=movieTerm';
        else if($media === 'music') $url.= '&attribute=songTerm';

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if($e = curl_error($ch)) return 500;
        else return json_decode($response, true);

    }

    public function searchItunes($term = '', $media = '')
    {
        $response = $this->executeRequestItunes($term, $media);
        if($response === 500) return $response;
        else return ($response['resultCount'] > 0) ? $response : 404;
    }

}

?>