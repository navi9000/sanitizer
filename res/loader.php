<?php

require_once LIB_ROOT . 'DataType.php';
spl_autoload_register(function ($classList) {
    require_once LIB_ROOT . 'dataTypes/' . $classList . '.php';
});