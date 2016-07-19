<?php
namespace def\Cipher;

class Dummy implements CipherInterface
{
    public function encode(string $string) : string
    {
        return $string;
    }

    public function decode(string $string) : string
    {
        return $string;
    }
}
