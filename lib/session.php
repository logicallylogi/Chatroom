<?php
session_start();
if (in_array("token", $_SESSION)) {
    $token = $_SESSION['token'];
}
