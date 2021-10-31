<?php
class ViewController{

    private static $view_path = './views/';

    public function load_view($view){

        require_once(self::$view_path. $view . '.php');
            
    }

}
                                  
?>