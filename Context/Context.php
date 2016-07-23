<?php
namespace def\Cipher\Context;

class Context implements ContextInterface
{
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function get(string $key)
    {
        return $this->data[$key];
    }

    public function exists(string $key) : bool
    {
        return isset($this->data[$key]);
    }
}
