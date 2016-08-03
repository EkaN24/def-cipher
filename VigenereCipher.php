<?php
namespace def\Cipher;

use def\Cipher\Alphabet\AlphabetInterface;
use OutOfBoundsException;
use InvalidArgumentException;

class VigenereCipher implements CipherInterface
{
    /**
     * @var def\Cipher\Alphabet\AlphabetInterface
     */
    private $alphabet;

    private $shifts = [];

    public function __construct(AlphabetInterface $alphabet, $keyword)
    {
        try {
            foreach (str_split($keyword) as $letter) {
                $this->shifts[] = $alphabet->getLetterCode($letter);
            }
        } catch (OutOfBoundsException $e) {
            throw new InvalidArgumentException("Only alphabet letters allowed", 0, $e);
        }

        $this->alphabet = $alphabet;
    }

    public function getAlphabet() : AlphabetInterface
    {
        return $this->alphabet;
    }

    public function encode(string $string) : string
    {
        $letters = [];

        $shiftsCount = count($this->shifts);

        foreach (str_split($string) as $i => $letter) {
            if (!$this->alphabet->isLetter($letter)) {
                $letters[] = $letter;
                continue;
            }

            $code = $this->alphabet->getLetterCode($letter);
            $code += $this->shifts[$i % $shiftsCount];
            $code %= $this->alphabet->getLength();

            $letters[] = $this->alphabet->getLetter($code);
        }

        return implode($letters);
    }

    public function decode(string $code) : string
    {
        $letters = [];

        $shiftsCount = count($this->shifts);

        foreach (str_split($code) as $i => $letter) {
            if (!$this->alphabet->isLetter($letter)) {
                $letters[] = $letter;
                continue;
            }

            $code = $this->alphabet->getLetterCode($letter);
            $code -= $this->shifts[$i % $shiftsCount];
            $code %= $this->alphabet->getLength();
            if ($code < 0) {
                $code += $this->alphabet->getLength();
            }

            $letters[] = $this->alphabet->getLetter($code);
        }

        return implode($letters);
    }
}
