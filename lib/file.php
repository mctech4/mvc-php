<?php
class file{
  public static function print($path){
    if (file_exists($path)) {
      $fp = fopen($path, 'r');
      if($fp){
        while(($c = fgets($fp)) !== false){
          echo $c;
        }
        fclose($fp);
      }
    }
  }
}