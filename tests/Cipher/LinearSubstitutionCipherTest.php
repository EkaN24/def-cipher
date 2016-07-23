<?php
namespace def\Cipher\Test\Cipher;

use def\Cipher\LinearSubstitutionCipher as Cipher;
use def\Cipher\Context\Context;
use def\Cipher\Alphabet\Alphabet;
use def\Cipher\Alphabet\EnglishAlphabet;
use def\Cipher\Alphabet\UkrainianAlphabet;

class LinearSubstitutionCipherTest extends AbstractCipherInterfaceTest
{
    public function getCiphers()
    {
        $alphabetEn = new EnglishAlphabet;
        $alphabetUk = new UkrainianAlphabet;

        $context = new Context([
            Cipher::CONTEXT_KEY_FACTOR => 3,
            Cipher::CONTEXT_KEY_SHIFT  => 8,
        ]);

        yield [new Cipher($alphabetEn, $context)];

        $context = new Context([
            Cipher::CONTEXT_KEY_FACTOR => 15,
            Cipher::CONTEXT_KEY_SHIFT  => 99,
        ]);

        yield [new Cipher($alphabetEn, $context)];

        $context = new Context([
            Cipher::CONTEXT_KEY_FACTOR => 7,
            Cipher::CONTEXT_KEY_SHIFT  => 1,
        ]);

        yield [new Cipher($alphabetUk, $context)];

        $context = new Context([
            Cipher::CONTEXT_KEY_FACTOR => 8,
            Cipher::CONTEXT_KEY_SHIFT  => 6,
        ]);

        yield [new Cipher($alphabetUk, $context)];
    }
}
