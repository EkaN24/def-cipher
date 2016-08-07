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
    private $enumeration = [];
    private $length;

    /**
     * instantiates an alphabet from letter[]
     * @param string[] $letters, MUST be single characters
     */
    public function __construct(array $letters)
    {
        $this->letters = array_combine($letters, $letters);
        $this->enumeration = array_values($this->letters);
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
        return isset($this->letters[$letter]);
    }

    /**
     * {@inheritdoc}
     */
    public function getLetter(int $code) : string
    {
        if (!isset($this->enumeration[$code])) {
            throw new OutOfRangeException("$code index out of range");
        }

        return $this->enumeration[$code];
    }

    /**
     * {@inheritdoc}
     */
    public function getLetterCode(string $letter) : int
    {
        if (false === $code = array_search($letter, $this->enumeration, true)) {
            throw new OutOfBoundsException("Undefined letter '$letter'");
        }

        return $code;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return $this->enumeration;
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
        return new ArrayIterator($this->enumeration);
    }
}
