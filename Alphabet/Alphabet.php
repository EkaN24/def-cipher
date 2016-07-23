<?php
namespace def\Cipher\Alphabet;

use Traversable;
use IteratorAggregate;
use ArrayIterator;
use OutOfRangeException;
use OutOfBoundsException;

class Alphabet implements IteratorAggregate, AlphabetInterface
{
    private $letters = [];
    private $length;

    /**
     * MUST be lowercase
     */
    public function __construct(array $letters)
    {
        $this->letters = array_values($letters);
    }

    public function getLength() : int
    {
        return $this->length ?? $this->length = count($this->letters);
    }

    public function isLetter(string $letter) : bool
    {
        return in_array($letter, $this->letters, true);
    }

    public function getLetter(int $code) : string
    {
        if (!isset($this->letters[$code])) {
            throw new OutOfRangeException("$code index out of range");
        }

        return $this->letters[$code];
    }

    public function getLetterCode(string $letter) : int
    {
        if (false === $code = array_search($letter, $this->letters, true)) {
            throw new OutOfBoundsException("Undefined letter '$letter'");
        }

        return $code;
    }

    public function toArray() : array
    {
        return $this->letters;
    }

    public function toString() : string
    {
        return implode($this->letters);
    }

    public function getIterator() : Traversable
    {
        return new ArrayIterator($this->letters);
    }
}
