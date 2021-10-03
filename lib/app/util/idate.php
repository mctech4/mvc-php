<?php

namespace app\util;

class idate
{
  public static function init($zone = "") {
    if (empty($zone)) {
      date_default_timezone_set(TIME_ZONE);
    } else {
      date_default_timezone_set($zone);
    }
  }
  public static function dateTime() {
    return date("Y-m-d H:i:s",time());
  }
  public static function date() {
    return date("Y-m-d");
  }
  public static function now() {
    return time();
  }
  public static function toTime($d) {
    return strtotime($d);
  }
  public static function time() {
    return date("H:m:s");
  }
  public static function ago($date) {
    try {
      $timestamp = strtotime($date);   
      $strTime = array("sec", "min", "hr", "d", "mon", "yr");   
      $length = array("60","60","24","30","12","10");   
      $currentTime = time();  
      if ($currentTime >= $timestamp) {    
        $diff = time()- $timestamp; 
        for ($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {      
            $diff = $diff / $length[$i];    
        }
        $diff = round($diff);
        
        if ($diff > 1) {
          return $diff . " " . $strTime[$i] . "s";
        } else {
            return $diff . " " . $strTime[$i];     
        } 
      }   
    } catch (Exception $e) {
        return $e;
    }
  }
}
