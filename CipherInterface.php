<?php
namespace def\Cipher;

interface CipherInterface
{
    public function encode(string $string) : string;

    public function decode(string $string) : string;
}
