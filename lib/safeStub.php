<?php

namespace lib;

define("REQUESTED", realpath($_SERVER["SCRIPT_FILENAME"]));

function stop($level = 1, $file = REQUESTED): void
{
    session_start();
    switch ($level) {
        case -1:
            http_response_code(403);
            connection_status();
            exit;
        case 0:
            if (REQUESTED == $file) {
                http_response_code(403);
                connection_status();
                exit;
            }
            break;
        case 1:
            if (array_key_exists("token", $_SESSION)) {
                // Reminder: Check the validity of this token!
                http_response_code(401);
                connection_status();
                exit;
            }
    }
}
