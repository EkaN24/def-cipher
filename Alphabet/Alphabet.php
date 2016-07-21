<?php
namespace def\Cipher\Alphabet;

use Traversable;
use IteratorAggregate;
use ArrayIterator;

class Alphabet implements IteratorAggregate, AlphabetInterface
{
    private $letters;
    private $length;

    public function __construct($first, $last)
    {
        $this->letters = range($first, $last);
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
        return $this->letters[$code];
    }

    public function getLetterCode(string $letter) : int
    {
        if (false !== $code = array_search($letter, $this->letters, true)) {
            return $code;
        }
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
