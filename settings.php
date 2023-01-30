<?php

declare(strict_types=1);

session_start();

require_once 'vendor/autoload.php';
$routes = [];
require_once 'routes.php';

$_SESSION['token']??= bin2hex(random_bytes(32));

define('DATA_LOGS', __DIR__ . '/logs.txt');
define('NOT_FOUND_ROUTE', [ Src\Actions\NotFound::class, 'report']);

define('URL', 'http://localhost:8080');
define('HOST', 'database'); 
define('USER', 'panda'); 
define('PASSWORD', 'panda'); 
define('NAME_BD', 'panda');

define('DEBUG_MODE', true ); 

if (DEBUG_MODE){
    ini_set("display_errors","1");
    ini_set("display_startup_errors","1");
    ini_set('error_reporting', E_ALL);
}

function dd($arg)
{
    echo "<br>";
    echo "<pre>";
     var_dump($arg);
    echo "<br>";

    exit();
}

function view(string $view, ?array $args=null) {
    if(isset($args)) extract($args);
    include_once ($_SERVER['DOCUMENT_ROOT'].'/../resources/view/'.$view);
}

function redirectToIndexPage()
{
    header('Location: '.URL);
    exit;
}

function Get($key, $arg)
{
    $GLOBALS['routes']['get'][$key] = $arg;
}

function Post($key, $arg)
{
    $GLOBALS['routes']['post'][$key] = $arg; 
}

function Any($key, $arg)
{
    $GLOBALS['routes']['any'][$key] = $arg; 
}