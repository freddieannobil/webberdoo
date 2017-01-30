<?php


use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;
use Webberdoo\App\AppKernel;

umask(0000);
/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/app/config/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . '/app/');
$dotenv->load();

$debug = $_SERVER['DEBUG'];
$env = $_SERVER['ENV'];

if($debug) {
    Debug::enable();
}

$kernel = new AppKernel($env,$debug);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
