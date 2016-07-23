<?php
namespace def\Cipher;

use def\Cipher\Alphabet\AlphabetInterface;
use def\Cipher\Context\ContextInterface;

interface CipherInterface
{
    public function __construct(AlphabetInterface $alphabet, ContextInterface $context = null);

    public function encode(string $string) : string;

    public function decode(string $code) : string;

    public function getAlphabet() : AlphabetInterface;
}
