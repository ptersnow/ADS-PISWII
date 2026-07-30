<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
if ($scriptDir !== '/' && $scriptDir !== '\\') {
    $uri = substr($uri, strlen($scriptDir));
}

$rota = '/' . trim($uri, '/');

if ($rota === '//') {
    $rota = '/';
}

if (array_key_exists($rota, $rotas)) {
    $controllerName = 'App\\Controllers\\' . $rotas[$rota]['controller'];
    $action = $rotas[$rota]['action'];
    
    $controller = new $controllerName();
    $controller->$action();
} else {
    http_response_code(404);
    echo "Rota não encontrada.";
}