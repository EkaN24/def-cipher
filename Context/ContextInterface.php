<?php
namespace def\Cipher\Context;

interface ContextInterface
{
    public function __construct(array $data = []);

    public function set(string $key, $value);

    public function get(string $key);

    public function exists(string $key) : bool;

    public function copy(ContextInterface $context);
}
