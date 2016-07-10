<?php

if(empty($_POST))
{
    require_once(__DIR__.'/../views/form.php');
}

session_start();

// include model
require_once(__DIR__.'/../models/AboutMyself.php');

// get field data
$personData = fetchFormData($formFields);
if (!$personData)
{
    header('Location: /');
    exit();
}

//validate file uploading
$fileUploaded = validateFile($formValidRules);
if (!$fileUploaded)
{
    header('Location: /');
    exit();
}

//validate data in fields
if (!validateFormData($personData, $formValidRules))
{
    header('Location: /');
    exit();
}
else
{
    header('Location: /success');
}

// change user txt file
$fileAboutMyself = updateTextFile($_SERVER['DOCUMENT_ROOT'] . $fileUploaded['txt'], $personData['euro2016']);

// save user data in sessions
$_SESSION['aboutmyself'] = $fileAboutMyself;
$_SESSION['userfiles'] = $fileUploaded;
$_SESSION['user'] = $personData;
