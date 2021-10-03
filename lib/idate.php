<?php
class idate
{
  private static $flag = 0;
  public static function init() {
    date_default_timezone_set(MAIN_SERVER_TIME_ZONE);
    self::$flag = 1;
  }

  public static function datetime() {
    if (self::$flag == 0)
      self::init();
    return date("Y-m-d H:i:s",time());
  }

  public static function date() {
    if (self::$flag == 0)
      self::init();
    return date("Y-m-d");
  }

  public static function now() {
    if (self::$flag == 0)
      self::init();
    return time();
  }

  public static function totime($d) {
    if (self::$flag == 0)
      self::init();
    return strtotime($d);
  }

  public static function time() {
    if (self::$flag == 0)
      self::init();
    return date("H:m:s");
  }

  public static function ago($date) {
    if (self::$flag == 0)
      self::init();
    try {
      date_default_timezone_set(MAIN_SERVER_TIME_ZONE);
      $timestamp = strtotime($date);   
      $strTime = array("second", "minute", "hour", "day", "month", "year");   
      $length = array("60","60","24","30","12","10");   
      $currentTime = time();  
      if ($currentTime >= $timestamp) {    
        $diff = time()- $timestamp; 
        for ($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {      
            $diff = $diff / $length[$i];    
        }
        $diff = round($diff);
        
        if ($diff > 1) {
          return $diff . " " . $strTime[$i] . "s". ''; // with S if greater than 1
        } else {
            return $diff . " " . $strTime[$i].'';     
        } 
      }   
    } catch (Exception $e) {
        return $e;
    }
  }
}