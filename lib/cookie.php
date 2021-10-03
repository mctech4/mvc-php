<?php

class cookie
{
  private static $path="/";
  public static function set($key, $value, $expire = 1)
  {
    setcookie($key, $value, time() + (86400 * $expire), self::$path);
  }
  public static function get($key)
  {
    if(isset($_COOKIE[$key])){
      return $_COOKIE[$key];
    }
    return null;
  }
  public static function unset($key)
  {
    setcookie($key, "", time() - 3600,self::$path);
  }
}