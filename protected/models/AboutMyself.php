<?php

// model data
$formFields = array(
    'name', 'secret', 'gender', 'occupation', 'euro2016', 'avatar', 'about', 'notRobot',
);

$formValidRules =array(
    'name' => [
        'type' => 'string',
        'length' => 50,
    ],
    'secret' => [
        'type' => 'string',
        'length' => 50,
    ],
    'gender' => [
        'type' => 'string',
        'value' => ['male', 'female'],
    ],
    'occupation' => [
        'type' => 'string',
        'value' => ['I\'m a student', 'I\'m a worker', 'I\'m a businesman', 'I\'m a free person'],
    ],
    'euro2016' => [
        'type' => 'string',
        'length' => 256,
    ],
    'avatar' => [
        'type' => 'file',
        'mime-type' => 'image/jpeg',
        'size' => 1024000,
    ],
    'about' => [
        'type' => 'file',
        'mime-type' => 'text/plain',
        'size' => 1024000,
    ],
    'notRobot' => [
        'type' => 'string',
        'value' => ['yes',],
    ],
);


/**
 * @param array $formFields
 * @return bool
 */
function fetchFormData($formFields)
{
    foreach($_POST as $key => $value)
    {
        if (array_search($key, array_keys($formFields)) === false) {
            trigger_error("Invalid field", E_USER_WARNING);
            return false;
        }

        $data[$key] = $value;
    }
    return $data;
}


/**
 * @param array $data
 * @param array $formValidRules
 * @return bool
 */
function validateFormData($data, $formValidRules)
{
    foreach($data as $key => $value)
    {
        if (array_key_exists('length', $formValidRules[$key]) &&
            strlen($data[$key]) > $formValidRules[$key]['length'])
        {
            trigger_error("Length should be less than $formValidRules[$key]['length']", E_USER_WARNING);
            return false;
        }

        if ($formValidRules[$key]['type'] == 'string')
        {
            if (!is_string($data[$key]))
            {
                trigger_error("Value must be string type", E_USER_WARNING);
                return false;
            }

            $data[$key] = strip_tags(htmlentities($data[$key]));
        }

        if (array_key_exists('value', $formValidRules[$key]) &&
            array_search($data[$key], $formValidRules[$key]['value']) === false)
        {
            trigger_error("Value should be one of the following: 
            implode(',', $formValidRules[$key]['value'])", E_USER_WARNING);
            return false;
        }
    }

    return true;
}

/**
 * @param array $formValidRules
 * @return bool
 */
function validateFile($formValidRules)
{
    foreach($_FILES as $key => $file)
    {
        if ($file['size'] > $formValidRules[$key]['size'])
        {
            trigger_error("File should be less than $formValidRules[$key]['size'] bytes", E_USER_WARNING);
            return false;
        }

        if ($file['type'] != $formValidRules[$key]['mime-type'])
        {
            trigger_error("File should be $formValidRules[$key]['mime-type'] type", E_USER_WARNING);
            return false;
        }

        $fileContent = file_get_contents($file['tmp_name']);

        if ($fileContent === false)
        {
            trigger_error("Error occurred while reading from file", E_USER_WARNING);
            return false;
        }

        if ($file['type'] == 'image/jpeg') $prefix = 'img';
        if ($file['type'] == 'text/plain') $prefix = 'txt';

        $filepath[$prefix] = makeFilePath($prefix, $file['name']);
        $filepathFull = $_SERVER['DOCUMENT_ROOT'] . $filepath[$prefix];

        if (file_put_contents($filepathFull, $fileContent) === false)
        {
            trigger_error("Error occurred while writing to file", E_USER_WARNING);
            return false;
        }
    }

    return $filepath;
}

/**
 * @param string $prefix
 * @param string $oldname
 * @return string
 */
function makeFilePath($prefix, $oldname)
{
    $name = explode('.', $oldname);
    $extension = array_pop($name);

    return '/uploads/' . $prefix . '/' . implode('', $name) . '_' . time() . '.' . $extension;
}


/**
 * @param string $fileName
 * @param string $text
 * @return bool|string
 */
function updateTextFile($fileName, $text)
{
    $fp = fopen($fileName, 'a+');
    if (!$fp) return false;
    if (!fwrite($fp, "\n My opinion about ukrainian football: ".$text)) return false;
    fclose($fp);

    return file_get_contents($fileName);
}
