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

        $counter = 0;

        foreach (str_split($string) as $letter) {
            if ($this->alphabet->isLetter($letter)) {
                $code = $this->alphabet->getLetterCode($letter);
                $code += $this->shifts[$counter % $shiftsCount];
                $code %= $this->alphabet->getLength();

                $letters[] = $this->alphabet->getLetter($code);

                $counter++;
            } else {
                $letters[] = $letter;

                if (preg_match("~^\\pL$~u", $letter)) {
                    $counter++;
                }
            }
        }

        return implode($letters);
    }

    public function decode(string $code) : string
    {
        $letters = [];

        $shiftsCount = count($this->shifts);

        $counter = 0;

        foreach (str_split($code) as $letter) {
            if ($this->alphabet->isLetter($letter)) {
                $code = $this->alphabet->getLetterCode($letter);
                $code -= $this->shifts[$counter % $shiftsCount];
                $code %= $this->alphabet->getLength();
                if ($code < 0) {
                    $code += $this->alphabet->getLength();
                }

                $letters[] = $this->alphabet->getLetter($code);

                $counter++;
            } else {
                $letters[] = $letter;

                if (preg_match("~^\\pL$~", $letter)) {
                    $counter++;
                }
            }
        }

        return implode($letters);
    }
}
