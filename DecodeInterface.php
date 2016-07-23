<?php
namespace def\Cipher;

interface DecodeInterface
{
    /**
     * @param string $code
     * @return string decoded string
     */
    public function decode(string $code) : string;
}
