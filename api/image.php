<?php
include_once ""
// This allows us to convert images around for proper formatting/sizing as-needed
// EX: image.php?src=example.png&w=100&h=100&f=png
$img = new Image($_GET["src"], $_GET["w"], $_GET["h"], $_GET["f"], $_GET["raw"]);
$img->render();
