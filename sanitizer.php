<?php

define('LIB_ROOT', dirname(__FILE__) . "/" . "res/");

require_once LIB_ROOT . 'loader.php';

class Sanitizer {
    public static function sanitize($json, $params):array
    {
        self::validateJSON($json);
        self::validateDataTypeArray($params);
        $output = json_decode($json, true);
        if (count($output) != count($params)) {
            throw new Exception('Number of elements does not match');
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
            throw new Exception(implode('; ', $errors));
        }
        else return $output;
    }

    public static function validateJSON($data):void
    {
        $isJSON = is_string($data) && is_array(json_decode($data, true)) && (json_last_error() == JSON_ERROR_NONE);
        if (!$isJSON) {
            throw new Exception('The first parameter must be in json format');
        }
    }

    public static function validateDataType($string):void
    {
        if (!is_string($string)) {
            throw new Exception('Error: Function parameter must be of type string');
        }
        if (!file_exists(LIB_ROOT . 'dataTypes/' . $string . '.php')) {
            throw new Exception('Data type "' . $string . '" does not exist');
        }
    }

    public static function validateDataTypeArray($array):void
    {
        if(!is_array($array)) {
            throw new Exception('Error: Function parameter must be of type array');
        }
        foreach($array as $string) {
            self::validateDataType($string);
        }
    }

    public static function showDataTypes():array
    {
        $dir = scandir(LIB_ROOT . 'dataTypes');
        $dataTypes = [];
        for ($i = 0; $i < count($dir); $i++) {
            if (preg_match('/\.php$/i', $dir[$i]) == 1) {
                $dataTypes[] = rtrim($dir[$i], '.php');
            }
        }
        return $dataTypes;
    }
}