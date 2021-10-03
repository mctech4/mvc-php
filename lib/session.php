<?php
class session {
  public static function start() {
    if (defined("SESSION_START"))
      return;
    define("SESSION_START", 1);
    session_start();
  }
}