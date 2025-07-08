<?php

declare(strict_types=1);

session_start();

require_once 'vendor/autoload.php';
$routes = [];
require_once 'routes.php';

$_SESSION['token'] ??= bin2hex(string: random_bytes(length: 32));

const DATA_LOGS = __DIR__ . '/logs.txt';
const NOT_FOUND_ROUTE = [Src\Actions\NotFound::class, 'report'];

const URL = 'http://localhost:8080';
const HOST = 'database';
const USER = 'panda';
const PASSWORD = 'panda';
const NAME_BD = 'panda';

const DEBUG_MODE = true;

if (DEBUG_MODE){
    ini_set(option: "display_errors",value: "1");
    ini_set(option: "display_startup_errors",value: "1");
    ini_set(option: 'error_reporting', value: E_ALL);
}

function dd($arg): void
{
    echo "<br>";
    echo "<pre>";
     var_dump(value: $arg);
    echo "<br>";

    exit();
}

function view(string $view, ?array $args=null): void
{
    if(isset($args)) extract(array: $args);
    include_once ($_SERVER['DOCUMENT_ROOT'].'/../resources/view/'.$view);
}

function redirectToIndexPage(): void
{
    header(header: 'Location: '.URL);
    exit;
}

function Get($key, $arg): void
{
    $GLOBALS['routes']['get'][$key] = $arg;
}

function Post($key, $arg): void
{
    $GLOBALS['routes']['post'][$key] = $arg; 
}

function Any($key, $arg): void
{
    $GLOBALS['routes']['any'][$key] = $arg; 
}