<?php
namespace def\Cipher\Test\Alphabet;

use def\Cipher\Alphabet\Alphabet;
use def\Cipher\Alphabet\EnglishAlphabet;
use def\Cipher\Alphabet\UkrainianAlphabet;

class AlphabetTest extends AbstractAlphabetInterfaceTest
{
    /**
     * {@inheritdoc}
     */
    public function getAlphabets()
    {
        return [
            [ new EnglishAlphabet ],
            [ new UkrainianAlphabet ],
            [ new Alphabet([]) ],
            [ new Alphabet(range('d', 'f')) ],
        ];
    }
}
