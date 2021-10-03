<?php 
//to use db::escape([&$var1, &$var2]);

class db {
  private static $con = 0;
  private static $is_init = 0;
  private static $flag = 0;
  public static function init() {
    self::$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    self::$flag = 1;
  }
  public static function escape($k = []) {
    if (self::$flag == 0)
      self::init();
    $len = count($k);
    for ($i = 0; $i < $len; $i++) {
      $k[$i] = mysqli_real_escape_string(self::$con, $k[$i]);
    }
  }
  public static function query($query) {
    if (self::$flag == 0)
      self::init();
    $buffer = [];
    $q = mysqli_query(self::$con, $query);
    $error = mysqli_error(self::$con);
    if ($error != "")
      throw new Exception($error, 1);
    if ($query[0] == "s" || $query[0] == "S") {
      $len = mysqli_num_rows($q);
      while($row = mysqli_fetch_assoc($q))
        $buffer[] = $row;
      mysqli_close(self::$con);
      self::$flag = 0;
      return ['data' => $buffer, 'total' => $len, 'id'];
    }
    
    if ($query[0] == "i" || $query[0] == "I")
      $buffer = mysqli_insert_id(self::$con);
    mysqli_close(self::$con);
    self::$flag = 0;
    return ['data' => [], 'total' => 0, 'id' => $buffer];
  }
}