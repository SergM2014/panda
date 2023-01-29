<?php

declare(strict_types=1);

namespace Src\Actions;

class Controller
{
    public function checkCsrf()
    {
        if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {

            if(isset($_POST['ajax'])) die();
            // return 405 http status code
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        }
    }
}