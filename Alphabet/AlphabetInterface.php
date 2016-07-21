<?php
namespace def\Cipher\Alphabet;

use Traversable;

interface AlphabetInterface extends Traversable
{
    public function getLength() : int;

    public function isLetter(string $letter) : bool;

    public function getLetter(int $code) : string;

    public function getLetterCode(string $letter) : int;

    public function toArray() : array;

    public function toString() : string;
}
