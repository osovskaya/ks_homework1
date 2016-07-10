<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

$requestUri = $_SERVER['REQUEST_URI'];

router($requestUri);

function router($uri)
{
    switch($uri)
    {
        case '/':
            include(__DIR__ . '/protected/views/form.php');
            break;
        case '/form':
            include(__DIR__ . '/protected/controllers/Form.php');
            break;
        case '/aboutmyself':
            include(__DIR__ . '/protected/controllers/AboutMyself.php');
            break;
        case '/success':
            include(__DIR__ . '/protected/views/success.php');
            break;
        default:
            include(__DIR__ . '/protected/views/404NotFound.php');
    }
}