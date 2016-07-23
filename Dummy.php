<?php
namespace def\Cipher;

/**
 * does nothing
 */
class Dummy implements CipherInterface
{
    public function __construct(AlphabetInterface $alphabet)
    {
        // pass
    }

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
