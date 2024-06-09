<?php

use lib\Includes;

define("APP_ROOT", realpath(getcwd() . "/../"));
define("REQUEST_URL", realpath($_GET["page"]));

require_once APP_ROOT . "/lib/Includes.php";

Includes::import_lib("lib/DB.php");
