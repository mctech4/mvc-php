<?php
define("WEB_APP", 1);
require_once "config/main_config.php";
require_once "lib/autoload.php";
$route = isset($_GET["route"]) ? $_GET["route"] : "";
app::run($route);