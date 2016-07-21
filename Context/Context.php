<?php
namespace def\Cipher\Context;

class Context implements ContextInterface
{
    protected $data = [];

    public function set(string $key, $value)
    {
        $this->data[$key] = $value;
    }

    public function get(string $key)
    {
        return $this->data[$key];
    }

    public function exists(string $key)
    {
        return isset($this->data[$key]);
    }

    public function copy(ContextInterface $context)
    {
        $this->data = array_merge($this->data, $context->data);
    }
}
