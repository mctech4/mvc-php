<?php

namespace app\util;
/*
 * str::array([string1, string2, ...])->email(length)->number(length)->safe(1)->phone("+63")
 *
*/
class valid {
  //class validator
  private $error = [];
  private $str = [];
  
  private $isValid = 1;

  // reqular expression and flags
  private $emailReg = '/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
  private $emailFlag = 0;
  //valid decimal
  private $decimalReg = '/^[+-]?((\d+(\.\d*)?)|(\.\d+))$/';
  private $decimalFlag = 0;
  
  /*phone*/
  private $phoneReg = '/^([+]?[1-9]{2})?[0]?([9][0-9]{9})$/';
  private $phoneFlag = 0;
  
  /*Alpha*/
  private $alhpaReg = '/^[a-zA-Z \.ńŃ]+$/';
  private $alphaFlag = 0;

  /*escaping from html*/
  private $isSafe = 0;
  
  /*valid character string allowed*/
  private $validInputReg = '/^[a-zA-Z0-9 +\.*-_@$%\';:#"]+$/';
  private $isValidInput = 0;
  /*options*/
  private $option = [];

  public function __construct($str = []) {
    $this->str = $str;
  }
  // list of functions
  public function email() {
    $this->emailFlag = 1;
    return $this;
  }
  public function phone() {
    $this->phoneFlag = 1;
    return $this;
  }
  public function number() {
    $this->decimalFlag = 1;
    return $this;
  }
  public function alpha() {
    $this->alphaFlag = 1;
    return $this;
  }
  public function safe() {
    $this->isSafe = 1;
    return $this;
  }
  public function option($arr = []) {
    $this->option = $arr;  
    return $this;
  } 
  public function validInput() {
    $this->isValidInput = 1;
    return $this; 
  }
  private function _opt($k) {
    foreach ($this->option as $sk) {
      if ($k == $sk) {
        return true;
      }
    }
    return false;
  }
  public function init() {
    foreach ($this->str as $k => $v) {
      if (!empty($this->option)) {
        if (!$this->_opt($this->str[$k])) {
          $this->error["error"] = "Invalid String: check for option";
        }
      }
      if ($this->isSafe) {
        $this->str[$k] = addslashes(htmlspecialchars($v));
      }
      if ($this->emailFlag) {
        if(!$this->validator($this->emailReg, $this->str[$k])) {
          $this->error['error'] = 'email is not valid';
          $this->isValid = 0;
        }
      }
      if ($this->decimalFlag) {
        if(!$this->validator($this->decimalReg, $this->str[$k])) {
          $this->error['error'] = 'Decimal is not Valid';
          $this->isValid = 0;
        }
      }
      if ($this->phoneFlag) {
        if(!$this->validator($this->phoneReg, $this->str[$k])) {
          $this->error['error'] = 'Phone is not Valid';
          $this->isValid = 0;
        } 
      }
      if ($this->alphaFlag) {
        if(!$this->validator($this->alhpaReg, $this->str[$k])) {
          $this->error['error'] = 'Only a to z or A to Z allowed';
          $this->isValid = 0;
        } 
      }
      if ($this->isValidInput) {
        if(!$this->validator($this->validInputReg, $this->str[$k])) {
          $this->error['error'] = 'Only Valid Character allowed';
          $this->isValid = 0;
        } 
      }

    }
    return $this;
  }

  public function error() {
    if (!empty($this->error)) {
      print json_encode($this->error);
    }
    return $this;
  }
  public function valid() {
    if ($this->isValid) {
      return true;
    }
    exit();
  }
  private function validator($regex, $txt) {
    if (preg_match($regex, $txt)) {
     return true;
    }
    return false;
  }
}
class str {
  public static function array($str = []) {
    return new valid($str);
  }
  public static function set($str) {
    
    foreach ($str as $k)
    { 
      $k = isset($k) ? $k : "";
    } 
  }
}