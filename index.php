<?php
session_start();
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
require_once __DIR__ . '/app/config/const.php';
date_default_timezone_set(TIME_ZONE);
require_once ROOT . '/vendor/autoload.php';

use core\Router;
use \core\base\bewedoc\Bewedoc;
Bewedoc::services();
Router::run($_SERVER['REQUEST_URI']);

