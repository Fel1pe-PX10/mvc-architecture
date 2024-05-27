<?php

namespace App\Controllers;

class Controller {

    protected function view($route, $data = []){
        
        $route = str_replace(".", "/", $route);

        if(!file_exists("../resources/views/{$route}.php"))
            return 'View doesn\'t exist';

        extract($data);

        ob_start();
        include "../resources/views/{$route}.php";
        $content = ob_get_clean();

        return $content;
    }

    protected function redirect($route){
        header("Location: {$route}");
    }
}