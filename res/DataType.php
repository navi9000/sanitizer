<?php

abstract class DataType
{
    public $value;
    public $error = null;
    protected $format = '';
    public function __construct($value)
    {
        $this->value = $value;
        if (!$this->isInstance()) {
            switch(gettype($this->value)) {
                case 'array':
                    error_reporting(E_ALL & ~E_NOTICE);
                    $this->error = 'Error: Array[' . implode(', ', $this->value) . '] is not of type ' . get_class($this) . $this->format;
                    break;
                case 'object':
                    $this->error = 'Error: Object{' . implode(', ', get_object_vars($this->value)) . '} is not of type ' . get_class($this) . $this->format;
                    break;
                case 'null':
                case 'resource':
                    $this->error = 'Error: ' . gettype($this->value) . ' is not of type ' . get_class($this) . $this->format;
                    break;
                default:
                    $this->error = 'Error: ' . $this->value . ' is not of type ' . get_class($this) . $this->format;       
            }
        }
    }
    
    abstract protected function isInstance():bool;
}