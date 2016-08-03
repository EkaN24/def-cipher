<?php
namespace def\Cipher\Test\Cipher;

use def\Cipher\VigenereCipher as Cipher;
use def\Cipher\Alphabet\Alphabet;
use def\Cipher\Alphabet\EnglishAlphabet;
use def\Cipher\Alphabet\UkrainianAlphabet;

class VigenereCipherTest extends AbstractCipherInterfaceTest
{
    public function getCiphers()
    {
        $alphabetEn = new EnglishAlphabet;
        $alphabetUk = new UkrainianAlphabet;

        return [
            [ new Cipher($alphabetEn, "lemon") ],
            [ new Cipher($alphabetEn, "passphrase") ],
            [ new Cipher($alphabetUk, $alphabetUk->toString()) ],
            [ new Cipher($alphabetUk, "пароль") ],
        ];
    }
}
