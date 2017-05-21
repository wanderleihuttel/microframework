<?php
require_once __DIR__ . "/../vendor/autoload.php";

print_r(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
