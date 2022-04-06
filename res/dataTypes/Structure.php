<?php

class Structure extends DataType
{
    protected $format = ', which must follow this pattern: array("keys" => ["string1", "string2", ...])';
    protected function isInstance(): bool
    {
        if (!is_array($this->value)) return false;
        if (count($this->value) != 1 || !isset($this->value['keys']) || !is_array($this->value['keys'])) return false;
        $keys = $this->value['keys'];
        for ($i = 0; $i < count($keys); $i++) {
            if (!array_key_exists($i, $keys) || !is_string($keys[$i])) return false;
        }
        return true;
    }
}