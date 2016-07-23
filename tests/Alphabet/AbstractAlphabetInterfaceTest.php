<?php
namespace def\Cipher\Test\Alphabet;

use def\Cipher\Alphabet\AlphabetInterface;

abstract class AbstractAlphabetInterfaceTest extends \PHPUnit_Framework_TestCase
{
    abstract public function getAlphabets();

    /**
     * @dataProvider getAlphabets
     */
    public function testImplements($alphabet)
    {
        $this->assertInstanceOf(AlphabetInterface::class, $alphabet);
    }

    /**
     * @dataProvider getAlphabets
     */
    public function testGetLetter($alphabet)
    {
        foreach ($alphabet as $key => $letter) {
            $this->assertEquals($letter, $alphabet->getLetter($key));
        }
    }

    /**
     * @dataProvider getAlphabets
     */
    public function testIsLetter($alphabet)
    {
        foreach ($alphabet as $letter) {
            $this->assertTrue($alphabet->isLetter($letter));
        }
    }

    /**
     * @dataProvider getAlphabets
     */
    public function testGetLetterCode($alphabet)
    {
        foreach ($alphabet as $key => $letter) {
            $this->assertEquals($key, $alphabet->getLetterCode($letter));
        }
    }

    /**
     * @dataProvider getAlphabets
     */
    public function testLetterIsChar($alphabet)
    {
        $encoding = mb_detect_encoding($alphabet->toString());

        foreach ($alphabet as $letter) {
            $this->assertEquals(1, mb_strlen($letter, $encoding));
        }
    }

    /**
     * @dataProvider getAlphabets
     */
    public function testLetterIsLowercase($alphabet)
    {
        $encoding = mb_detect_encoding($alphabet->toString()) ?: mb_internal_encoding();

        foreach ($alphabet as $letter) {
            $this->assertEquals(mb_strtolower($letter), $letter);
        }
    }
}
