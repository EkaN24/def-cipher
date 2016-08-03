<?php
namespace def\Cipher;

/**
 * does nothing
 */
class Dummy implements EncodeInterface, DecodeInterface
{
    /**
     * {@inheritdoc}
     */
    public function encode(string $string) : string
    {
        return $string;
    }

    /**
     * {@inheritdoc}
     */
    public function decode(string $code) : string
    {
        return $code;
    }
}
