<?php
namespace def\Cipher\Context;

interface ContextInterface
{
    public function set(string $key, $value);

    public function get(string $key);

    public function exists(string $key) : boolean;

    public function copy(ContextInterface $context);
}
