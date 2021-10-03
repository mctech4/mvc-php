<?php
class view {
  public static function load($file, $data = []) {
    $path = 'views/'.$file.'.php';
    if (!file_exists($path))
      return print 'View Not found '.$path;
    if (!empty($data)) {
      foreach ($data as $key => $value) {
        ${$key} = $value;
      }
    }
    require $path;
    return 1;
  }
}