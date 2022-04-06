<?php

class SymbolString extends DataType
{
    protected function isInstance(): bool
    {
        return is_string($this->value);
    }
}