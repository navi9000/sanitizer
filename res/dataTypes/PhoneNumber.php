<?php

class PhoneNumber extends DataType
{
    protected $format = ', which must follow this pattern: 8 (000) 000-00-00';
    protected function isInstance(): bool
    {
        return is_string($this->value) && preg_match("/[7|8] \(\d{3}\) \d{3}-\d{2}-\d{2}/", $this->value) == 1;
    }
}