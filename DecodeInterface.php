<?php
namespace def\Cipher;

interface DecodeInterface
{
    public function decode(string $code) : string;
}
