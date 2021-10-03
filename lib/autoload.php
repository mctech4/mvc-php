<?php 
function classLoader($className) {
  require_once $className.".php";
}
spl_autoload_register("classLoader");