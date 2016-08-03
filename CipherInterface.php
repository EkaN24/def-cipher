<?php
namespace def\Cipher;

use def\Cipher\Alphabet\AlphabetInterface;

interface CipherInterface extends EncodeInterface, DecodeInterface
{
    public function getAlphabet() : AlphabetInterface;
}
