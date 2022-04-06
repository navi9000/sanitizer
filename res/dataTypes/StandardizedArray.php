<?php

class StandardizedArray extends DataType
{
    protected $format = ', which must follow this pattern: ["AllowedType"]';
    protected function isInstance(): bool
    {
        if (!is_array($this->value) || !isset($this->value[0]) || count($this->value) != 1) return false;
        foreach(glob('*.php') as $file) {
            if (rtrim($file, '.php') == $this->value[0]) {
                return true;
            }   
        }
        return false;
    }
}