<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/app/config/const.php';
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
date_default_timezone_set(TIME_ZONE);
require_once ROOT . '/vendor/autoload.php';
echo $_SERVER['REQUEST_URI'];
use core\Router;
use \core\base\bewedoc\Bewedoc;
Bewedoc::services();
Router::run($_SERVER['REQUEST_URI']);

