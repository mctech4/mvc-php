<?php

class date {
  public static function age($bod, $date) {
    $bod   = strtotime($bod);
    $ddate = $date - $bod;

    return (int)($ddate / 31557600); /* total seconds in 365 1/4 days */
  }
}