<?php

require './Core/database.php';
require './Models/BaseModel.php';
require './Controllers/BaseController.php';
$controller = ucfirst((strtolower($_REQUEST['controller']) ?? 'Welcome') . 'Controller');
$action = $_REQUEST['action'] ?? 'index';

require "./Controllers/${controller}.php";

$controllerObject = new $controller;
$controllerObject->$action();



