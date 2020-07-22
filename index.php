<?php
define("APP_PATH",realpath("."));

require_once APP_PATH ."/app/config/loader.php";

$loadPage = new load();
$loadPage->load();
