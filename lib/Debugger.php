<?php

namespace lib;

use Throwable;

class Debugger
{
    private string $log_location;

    function __construct()
    {
        $location = realpath(APP_ROOT . "site.log");
        $this->log_location = $location;
    }

    function appendLog(Throwable|string $data): void
    {
        if (method_exists($data, "getMessage")) {
            $thrownMessage = $data->getMessage();
            if (strlen($thrownMessage) > 1) {
                file_put_contents($this->log_location, $data->getMessage(), FILE_APPEND, LOCK_EX);
            }
        } else if (strlen($data) > 1 && config->debug) {
            file_put_contents($this->log_location, $data, FILE_APPEND, LOCK_EX);
        }
    }

    function dumpLogs(): void
    {
        $logs = file($this->log_location, FILE_SKIP_EMPTY_LINES, LOCK_EX);
        foreach ($logs as $log) {
            echo Includes::import_template("error", ["data" => $log]);
        }
    }
}
