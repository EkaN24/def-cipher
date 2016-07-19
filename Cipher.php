<?php
namespace def\Cipher;

use InvalidArgumentException;

/**
 * sipmple proxy for ciphers
 */
class Cipher implements CipherInterface
{
    /**
     * @var CipherInterface
     */
    private $cipher;

    public function __construct(string $cipher, ...$cargs)
    {
        if (!is_subclass_of($cipher, CipherInterface::class)) {
            throw new InvalidArgumentException("Unknown '$cipher' cipher class");
        }

        $this->cipher = new $cipher(...$cargs);
    }

    public function encode(string $string) : string
    {
        return $this->cipher->encode($string);
    }

    public function decode(string $string) : string
    {
        return $this->cipher->decode($string);
    }
}
