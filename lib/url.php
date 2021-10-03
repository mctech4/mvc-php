<?php
class url {

  public static function post($key) {
    if (!isset($_POST[$key]))
      exit;
    return $_POST[$key];
  }
  public static function get($key) {
    if (!isset($_GET[$key]))
      exit;
    return $_GET[$key];
  }
}