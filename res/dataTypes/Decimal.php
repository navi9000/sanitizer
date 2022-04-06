<?php

class Decimal extends DataType
{
    protected function isInstance(): bool
    {
        return is_float($this->value);
    }
}