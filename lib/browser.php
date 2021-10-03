<?php
class browser {
  private static $ip = null;
  private static $port = null;
  private static $browserinfo = null;
  private static  $comname = null;
  private static $flag = 0;
  private static function init() {
    if (self::$flag == 0) {
      self::$ip = $_SERVER["REMOTE_ADDR"];
      self::$port = $_SERVER["REMOTE_PORT"];
      self::$browserinfo = $_SERVER["HTTP_USER_AGENT"];
      self::$comname = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
      self::$flag = 1;
    }
  }
  public static function deviceName() {
    self::init();
    return self::$comname;
  }
  public static function ip() {
    self::init();
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
     }
     elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
       //ip pass from proxy
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
     }
     else{
        $ip = $_SERVER['REMOTE_ADDR'];
     }
     return $ip;
  }
  public static function port() { 
    self::init();
    return self::$port;
  }
  public static function browserInfo() {
    self::init();
    return self::$browserinfo;
  }
  //information
}