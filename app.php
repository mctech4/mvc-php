<?php

class app {
  public static function error() {
    print 'Page Not Found';
  }
  public static function run($route) { 
    $path = 'lib/app/controllers/';
    $route = explode("/", $route);
    $class = !empty($route[0]) ? $route[0].'Controller' : 'indexController';
    $method = isset($route[1]) && !empty($route[1]) ? $route[1] : 'index';
    
    if (!file_exists($path.$class.'.php'))
      return self::error();
    require_once $path.$class.'.php';
    if (!class_exists($class))
      return self::error();
    $c = new $class();
    if (!method_exists($c, $method))
      return self::error();
    $c->$method();
  }
}