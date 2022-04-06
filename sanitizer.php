<?php

define('LIB_ROOT', dirname(__FILE__) . "/" . "res/");

require_once LIB_ROOT . 'loader.php';

class Sanitizer {
    public static function sanitize($json, $params)
    {
        self::validateJSON($json);
        self::validateDataTypeArray($params);
        $output = json_decode($json, true);
        if (count($output) != count($params)) {
            echo 'Error: Number of elements does not match';
            die;
        }
        $errors = [];
        $i = 0;
        foreach($output as $value) {
            $dataObject = new $params[$i++]($value);
            if (!is_null($dataObject->error)) {
                $errors[] = $dataObject->error;
            }
        }
        if (count($errors) != 0) {
            foreach($errors as $error) {
                echo $error . "<br/>";
            }
        }
        else var_dump($output);  
    }

    public static function validateJSON($data):void
    {
        $isJSON = is_string($data) && is_array(json_decode($data, true)) && (json_last_error() == JSON_ERROR_NONE);
        if (!$isJSON) {
            echo 'Error: The first parameter must be in json format';
            die;
        }
    }

    public static function validateDataType($string):void
    {
        if (!is_string($string)) {
            echo 'Error: Function parameter must be of type string';
            die;
        }
        if (!file_exists(LIB_ROOT . 'dataTypes/' . $string . '.php')) {
            echo 'Error: Data type "' . $string . '" does not exist';
            die;
        }
    }

    public static function validateDataTypeArray($array):void
    {
        if(!is_array($array)) {
            echo 'Error: Function parameter must be of type array';
            die;
        }
        foreach($array as $string) {
            self::validateDataType($string);
        }
    }

    public static function showDataTypes()
    {
        $dir = scandir(LIB_ROOT . 'dataTypes');
        $dataTypes = [];
        for ($i = 0; $i < count($dir); $i++) {
            if (preg_match('/\.php$/i', $dir[$i]) == 1) {
                $dataTypes[] = rtrim($dir[$i], '.php');
            }
        }
        echo implode(', ', $dataTypes);
    }
}

// Sanitizer::sanitize('{"foo": 123, "bar": "asd", "baz": "8 (950) 288-56-23"}', ['Integer', 'SymbolString', 'PhoneNumber']);
// Sanitizer::validateDataTypeArray(["key" => "Decima"]);
Sanitizer::showDataTypes();