<?php
namespace def\Cipher;

use def\Cipher\Alphabet\AlphabetInterface;
use def\Cipher\Context\ContextInterface;

interface CipherInterface extends EncodeInterface, DecodeInterface
{
    public function __construct(AlphabetInterface $alphabet, ContextInterface $context = null);

    public function getAlphabet() : AlphabetInterface;
}
