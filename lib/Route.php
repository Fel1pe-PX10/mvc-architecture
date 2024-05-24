<?php

namespace Lib;

class Route {
    private static $routes = [];

    public static function get($uri, $callback){
        $uri = trim($uri, '/');
        self::$routes['GET'][$uri] = $callback;
    }

    public static function post($uri, $callback){
        $uri = trim($uri, '/');
        self::$routes['POST'][$uri] = $callback;
    }

    public static function dispatch(){
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');

        $method = $_SERVER['REQUEST_METHOD'];

        foreach(self::$routes[$method] as $route => $callback){
            if($route == $uri){
                $callback();
                return;
            }
        }

        echo '404 not found';
    }

}   