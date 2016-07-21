<?php
namespace def\Cipher;

class Dummy implements CipherInterface
{
    public function __construct(AlphabetInterface $alphabet)
    {
        // pass
    }

    public function encode(string $string) : string
    {
        return $string;
    }

    public function decode(string $code) : string
    {
        return $code;
    }
}
