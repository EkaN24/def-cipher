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
     * instantiates an alphabet from letter[]
     * @param string[] $letters, MUST be lowercase single character
     */
    public function __construct(array $letters)
    {
        $this->letters = array_values($letters);
    }

    /**
     * {@inheritdoc}
     */
    public function getLength() : int
    {
        return $this->length ?? $this->length = count($this->letters);
    }

    /**
     * {@inheritdoc}
     */
    public function isLetter(string $letter) : bool
    {
        return in_array($letter, $this->letters, true);
    }

    /**
     * {@inheritdoc}
     */
    public function getLetter(int $code) : string
    {
        if (!isset($this->letters[$code])) {
            throw new OutOfRangeException("$code index out of range");
        }

        return $this->letters[$code];
    }

    /**
     * {@inheritdoc}
     */
    public function getLetterCode(string $letter) : int
    {
        if (false === $code = array_search($letter, $this->letters, true)) {
            throw new OutOfBoundsException("Undefined letter '$letter'");
        }

        return $code;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return $this->letters;
    }

    /**
     * {@inheritdoc}
     */
    public function toString() : string
    {
        return implode($this->letters);
    }

    /**
     * implements IteratorAggregate
     */
    public function getIterator() : Traversable
    {
        return new ArrayIterator($this->letters);
    }
}
