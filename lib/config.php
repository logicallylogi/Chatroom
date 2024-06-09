<?php

namespace lib;
define("config", (object)parse_ini_file("../config.ini.php", false, INI_SCANNER_TYPED));
