<?php
namespace def\Cipher\Test\Alphabet;

use def\Cipher\Alphabet\AlphabetInterface;

abstract class AbstractAlphabetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return def\Cipher\Alphabet\AlphabetInterface
     */
    abstract public function getAlphabet();

    public function testImplements()
    {
        $this->assertInstanceOf(AlphabetInterface::class, $this->getAlphabet());
    }

    /**
     * @dataProvider getLetters
     */
    public function testGetLetter($letter, $key)
    {
        $this->assertEquals($letter, $this->getAlphabet()->getLetter($key));
    }

    /**
     * @dataProvider getLetters
     */
    public function testIsLetter($letter)
    {
        $this->assertTrue($this->getAlphabet()->isLetter($letter));
    }

    /**
     * @dataProvider getLetters
     */
    public function testGetLetterCode($letter, $key)
    {
        $this->assertEquals($key, $this->getAlphabet()->getLetterCode($letter));
    }

    /**
     * @dataProvider getLetters
     */
    public function testLetterIsChar($letter)
    {
        $this->assertStringMatchesFormat("%c", $letter);
    }

    /**
     * @dataProvider getLetters
     */
    public function testLetterIsLowercase($letter)
    {
        $this->assertEquals(strtolower($letter), $letter);
    }

    public function getLetters()
    {
        foreach ($this->getAlphabet() as $key => $letter) {
            yield [$letter, $key];
        }
    }
}
