<?php
namespace def\Cipher\Context;

class Context implements ContextInterface
{
    protected $data = [];

    public function __set(string $key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __get(string $key)
    {
        return $this->data[$key];
    }

    public function __isset(string $key)
    {
        return isset($this->data[$key]);
    }
}
