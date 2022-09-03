<?php
namespace Tuezy\Router;

class RouterHelper{
    public static function computeCompiledName($method, $prefix, $uri): string{
        $explodeURI = explode('/', $uri);
        $prefix = self::startWithSlash($prefix);

        if($prefix != 'index' && $uri == '/'){
            $uri = '';
        }

        if(!empty($uri) && $prefix == '/'.$explodeURI[1]){
            return $method . $uri;
        }

        return $method . $prefix . $uri;
    }

    public static function calcPrefix($uri){
        $prefix = 'index';
        if(strlen($uri) > 1){
            $explodeURI = explode('/', $uri);
            $prefix = $explodeURI[1];
        }

        if(self::isStartWith($prefix, '{')){
            $prefix = 'index';
        }
        return $prefix;
    }

    public static function startWithSlash($uri){
        return (substr($uri, 0 , 1) == '/') ? $uri : '/'. $uri;
    }
    public static function endWithSlash($uri){
        return (substr($uri, 0 , -1) == '/') ? $uri : $uri . '/';
    }
    public static function removeSlash($uri){
        return preg_replace('/\//', '', $uri);
    }
    public static function isStartWith($str, $char){
        return (substr($str, 0 , 1) == $char);
    }
    public static function isEndWith($str, $char){
        return (substr($str, 0 , -1) == $char);
    }

    public static function formatURI($uri){
        $uri = self::startWithSlash($uri);
        if(substr($uri, 0 , -1) == '/'){
            $uri = substr($uri, 0 , strlen($uri) - 1);
        }
        return $uri;
    }
}