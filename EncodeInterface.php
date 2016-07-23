<?php
namespace def\Cipher;

interface EncodeInterface
{
    /**
     * @param string $string
     * @return string encoded string
     */
    public function encode(string $string) : string;
}
