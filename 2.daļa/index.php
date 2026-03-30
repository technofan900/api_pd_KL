<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$parts = explode('/', $path);

$src = $parts[2] ?? null;

if ($src && file_exists("$src.php")) {
    include "$src.php";
}