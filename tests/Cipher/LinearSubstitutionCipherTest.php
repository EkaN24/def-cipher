<?php
namespace def\Cipher\Test\Cipher;

use def\Cipher\LinearSubstitutionCipher as Cipher;
use def\Cipher\Alphabet\Alphabet;
use def\Cipher\Alphabet\EnglishAlphabet;
use def\Cipher\Alphabet\UkrainianAlphabet;

class LinearSubstitutionCipherTest extends AbstractCipherInterfaceTest
{
    public function getCiphers()
    {
        $alphabetEn = new EnglishAlphabet;
        $alphabetUk = new UkrainianAlphabet;

        return [
            [ new Cipher($alphabetEn, 3, 8) ],
            [ new Cipher($alphabetEn, 15, 99) ],
            [ new Cipher($alphabetUk, 7, 1) ],
            [ new Cipher($alphabetUk, 8, 6) ],
        ];
    }
}
