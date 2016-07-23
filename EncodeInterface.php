<?php
namespace def\Cipher;

interface EncodeInterface
{
    public function encode(string $string) : string;
}
