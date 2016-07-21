<?php
namespace def\Cipher\Context;

interface ContextInterface
{
    public function __set(string $key, $value);

    public function __get(string $key);

    public function __isset(string $key) : boolean;
}
