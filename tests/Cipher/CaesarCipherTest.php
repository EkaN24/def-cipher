<?php
namespace def\Cipher\Test\Cipher;

use def\Cipher\CaesarCipher as Cipher;
use def\Cipher\Context\Context;
use def\Cipher\Alphabet\Alphabet;
use def\Cipher\Alphabet\EnglishAlphabet;
use def\Cipher\Alphabet\UkrainianAlphabet;

class CaesarCipherTest extends LinearSubstitutionCipherTest
{
    public function getCiphers()
    {
        $alphabetEn = new EnglishAlphabet;
        $alphabetUk = new UkrainianAlphabet;

        $context = new Context([
            Cipher::CONTEXT_KEY_SHIFT  => 8,
        ]);

        yield [new Cipher($alphabetEn, $context)];

        $context = new Context([
            Cipher::CONTEXT_KEY_SHIFT  => 99,
        ]);

        yield [new Cipher($alphabetEn, $context)];

        $context = new Context([
            Cipher::CONTEXT_KEY_SHIFT  => 1,
        ]);

        yield [new Cipher($alphabetUk, $context)];

        $context = new Context([
            Cipher::CONTEXT_KEY_SHIFT  => 9999999,
        ]);

        yield [new Cipher($alphabetUk, $context)];
    }
}
