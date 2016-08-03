<?php
namespace def\Cipher;

use def\Cipher\Alphabet\AlphabetInterface;

/**
 * Caesar chiper
 * @see https://en.wikipedia.org/wiki/Caesar_cipher
 */
class CaesarCipher extends LinearSubstitutionCipher
{
    /**
     * {@inheritdoc}
     */
    public function __construct(AlphabetInterface $alphabet, int $shift)
    {
        parent::__construct($alphabet, 1, $shift);
    }
}
