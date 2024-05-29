<?php

# imports
use Api\ApiController;

# require config
require_once "../src/includes/config.php";

# set json and cors headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE');
header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Requested-With");
header('Content-Type: application/json; charset=utf-8');

# preflight error fix
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    die();
}

# handle api request
$api = new ApiController();
$api->run();
