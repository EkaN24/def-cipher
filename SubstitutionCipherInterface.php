<?php
namespace def\Cipher;

interface SubstitutionCipherInterface extends CipherInterface
{
    public function substitute(string $letter) : string;

    public function crack(string $code) : string;
}
