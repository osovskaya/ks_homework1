<?php

function formValidateErrorHandler($errno, $errstr)
{
    if ($errno == E_USER_WARNING)
    {
        return $errstr;
    }
    else
    {
        echo "<p class=\"error\">Unknown error type: [$errno] $errstr<p>";
    }

    return true;
}

$error = set_error_handler("formValidateErrorHandler");