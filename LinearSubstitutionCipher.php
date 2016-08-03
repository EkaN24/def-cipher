<?php
namespace def\Cipher;

use def\Cipher\Alphabet\AlphabetInterface;
use InvalidArgumentException;
use BadMethodCallException;

/**
 * makes a linear substitution x -> a*x + b mod alphabet length
 */
class LinearSubstitutionCipher implements SubstitutionCipherInterface
{
    /**
     * @var def\Cipher\Alphabet\AlphabetInterface
     */
    private $alphabet;

    /**
     * @var int
     */
    private $factor;

    /**
     * @var int
     */
    private $shift;

    /**
     * {@inheritdoc}
     */
    public function __construct(AlphabetInterface $alphabet, int $factor, int $shift)
    {
        $length = $alphabet->getLength();

        $factor %= $length;

        if ($factor < 0) {
            $factor += $length;
        }

        if (!coprime($factor, $length)) {
            throw new InvalidArgumentException(
                sprintf("Cipher factor (%d) and alphabet length (%d) need to be coprime", $length, $factor)
            );
        }

        $shift %= $length;

        if ($shift < 0) {
            $shift += $length;
        }


        $this->factor = $factor;
        $this->shift  = $shift;

        $this->alphabet = $alphabet;
    }

    /**
     * {@inheritdoc}
     */
    public function getAlphabet() : AlphabetInterface
    {
        return $this->alphabet;
    }

    /**
     * {@inheritdoc}
     */
    public function encode(string $string) : string
    {
        $chars = [];

        foreach (str_split($string) as $char) {
            $chars[] = $this->substitute($char);
        }

        return implode($chars);
    }

    /**
     * {@inheritdoc}
     */
    public function decode(string $code) : string
    {
        $length = $this->alphabet->getLength();

        $factor = inverse($this->factor, $length);
        $shift  = $length - (($factor * $this->shift) % $length);

        $chars = [];

        foreach (str_split($code) as $char) {
            $chars[] = self::subst($this->alphabet, $char, $factor, $shift);
        }

        return implode($chars);
    }

    /**
     * {@inheritdoc}
     */
    public function substitute(string $letter) : string
    {
        return self::subst($this->alphabet, $letter, $this->factor, $this->shift);
    }

    private static function subst(AlphabetInterface $alphabet, string $letter, int $factor, int $shift) : string
    {
        if (!$alphabet->isLetter($letter)) {
            return $letter;
        }

        $code = ($alphabet->getLetterCode($letter) * $factor + $shift) % $alphabet->getLength();

        return $alphabet->getLetter($code);
    }

    /**
     * {@inheritdoc}
     */
    public function crack(string $code) : string
    {
        throw new BadMethodCallException("Not implemented yet");
    }
}
