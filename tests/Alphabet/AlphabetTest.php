<?php
namespace def\Cipher\Test\Alphabet;

use def\Cipher\Alphabet\Alphabet;

class AlphabetTest extends AbstractAlphabetTest
{
    private $alphabet;

    /**
     * {@inheritdoc}
     */
    public function getAlphabet()
    {
        return $this->alphabet ?? $this->alphabet = new Alphabet('a', 'z');
    }

    public function setUp()
    {
        setlocale(LC_CTYPE, "en_US.UTF-8");
    }

    /**
     * @dataProvider getLetters
     */
    public function testLetterIsLowercase($letter)
    {
        $this->assertTrue(ctype_lower($letter));
    }
}
