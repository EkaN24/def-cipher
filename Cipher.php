<?php
namespace def\Cipher;

class Cipher
{
    public static function merge(CipherInterface ...$ciphers) : CipherInterface
    {
        return new class($ciphers) implements CipherInterface {
            private $ciphers;

            public function __construct(array $ciphers)
            {
                $this->ciphers = $ciphers;
            }

            public function encode(string $string) : string
            {
                foreach ($this->ciphers as $cipher) {
                    $string = $cipher->encode($string);
                }
                return $string;
            }

            public function decode(string $string) : string
            {
                foreach (array_reverse($this->ciphers) as $cipher) {
                    $string = $cipher->decode($string);
                }
                return $string;
            }
        };
    }
}
