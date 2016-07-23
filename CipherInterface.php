<?php
namespace def\Cipher;

use def\Cipher\Alphabet\AlphabetInterface;
use def\Cipher\Context\ContextInterface;

interface CipherInterface extends EncodeInterface, DecodeInterface
{
    /**
     * instantiates a cipher with an alphabet and context (key storage, etc)
     *
     * @param AlphabetInterface $alphabet
     * @param ContextInterface|null $context
     */
    public function __construct(AlphabetInterface $alphabet, ContextInterface $context = null);

    public function getAlphabet() : AlphabetInterface;
}
