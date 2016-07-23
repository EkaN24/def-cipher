<?php
namespace def\Cipher\Alphabet;

use Traversable;

interface AlphabetInterface extends Traversable
{
    /**
     * @return int number of letters
     */
    public function getLength() : int;

    /**
     * checks wheter a letter is the alphabet letter
     * @param string $letter
     * @param bool
     */
    public function isLetter(string $letter) : bool;

    /**
     * get letter by its code (position in alphabet)
     * @param int $code MUST be between 0 and getLength()
     * @return string
     * @throws \OutOfRangeException
     */
    public function getLetter(int $code) : string;

    /**
     * get letter position in alphabet
     * @param string $letter
     * @return int
     * @throws \OutOfBoundsException
     */
    public function getLetterCode(string $letter) : int;

    /**
     * @return string[] letters
     */
    public function toArray() : array;

    /**
     * @return string alphabet in one string
     */
    public function toString() : string;
}
