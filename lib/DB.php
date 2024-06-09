<?php

namespace lib;

use mysqli;

Includes::import_lib("lib/config.php");

class DB
{
    static private mysqli $db;

    public function __construct()
    {
        self::$db = new mysqli(config->db_host, config->db_username, config->db_password, config->db_name, config->db_port);
        self::$db->client_info;
    }
}
