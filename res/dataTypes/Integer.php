<?php

class Integer extends DataType
{
    protected function isInstance(): bool
    {
        return is_int($this->value);
    }
}