<?php
namespace def\Cipher;

/**
 * merge ciphers into one
 */
class Compose implements EncodeInterface, DecodeInterface
{
    /**
     * @var CipherInterface[]
     */
    private $ciphers;

    public function __construct(CipherInterface ...$ciphers)
    {
        $this->ciphers = $ciphers;
    }

    /**
     * {@inheritdoc}
     */
    public function encode(string $string) : string
    {
        $code = $string;

        foreach ($this->ciphers as $cipher) {
            $code = $cipher->encode($code);
        }

        return $code;
    }

    /**
     * {@inheritdoc}
     */
    public function decode(string $code) : string
    {
        $string = $code;

        foreach (array_reverse($this->ciphers) as $cipher) {
            $string = $cipher->decode($string);
        }

        return $string;
    }
}
