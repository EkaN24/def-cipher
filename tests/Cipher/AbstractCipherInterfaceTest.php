<?php
namespace def\Cipher\Test\Cipher;

use def\Cipher\CipherInterface;
use def\Cipher\Alphabet\AlphabetInterface;

abstract class AbstractCipherInterfaceTest extends \PHPUnit_Framework_TestCase
{
    private static $randomStringsCount = 32;

    private static $sampleNonLetterChars = [
        ' ', '@', '!', '#', '%', '&', '?', '(', ')', '-', '+', '*', '$', '.', ',',
        '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
    ];

    abstract public function getCiphers();

    /**
     * @dataProvider getCiphers
     */
    public function testImplements($cipher)
    {
        $this->assertInstanceOf(CipherInterface::class, $cipher);
    }

    /**
     * @dataProvider getCiphers
     */
    public function testDecodeEncode($cipher)
    {
        $alphabet = $cipher->getAlphabet();

        foreach (self::getRandomStrings($cipher->getAlphabet()) as $string) {
            $this->assertEquals($string, $cipher->decode($cipher->encode($string)));
        }
    }

    /**
     * @retrun string[]
     */
    private static function getRandomStrings(AlphabetInterface $alphabet)
    {
        $characters = array_merge($alphabet->toArray(), self::$sampleNonLetterChars);

        $charactersLength = count($characters);

        for ($i = 0; $i < self::$randomStringsCount; $i++) {
            yield implode(array_map(function ($key) use ($characters) {
                return $characters[$key];
            }, array_rand($characters, rand(2, $charactersLength))));
        }
    }
}
