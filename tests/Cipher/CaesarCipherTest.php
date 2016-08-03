<?php
namespace def\Cipher\Test\Cipher;

use def\Cipher\CaesarCipher as Cipher;
use def\Cipher\Alphabet\Alphabet;
use def\Cipher\Alphabet\EnglishAlphabet;
use def\Cipher\Alphabet\UkrainianAlphabet;

class CaesarCipherTest extends LinearSubstitutionCipherTest
{
    public function getCiphers()
    {
        $alphabetEn = new EnglishAlphabet;
        $alphabetUk = new UkrainianAlphabet;

        return [
            [ new Cipher($alphabetEn, 8) ],
            [ new Cipher($alphabetEn, 99) ],
            [ new Cipher($alphabetUk, 1) ],
            [ new Cipher($alphabetUk, 999999) ],
        ];
    }
}
