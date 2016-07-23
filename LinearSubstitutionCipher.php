<?php
namespace def\Cipher;

use def\Cipher\Alphabet\AlphabetInterface;
use def\Cipher\Context\ContextInterface;
use def\Cipher\Context\Context;
use InvalidArgumentException;
use BadMethodCallException;

class LinearSubstitutionCipher implements SubstitutionCipherInterface
{
    const CONTEXT_KEY_FACTOR = self::class . '-factor';
    const CONTEXT_KEY_SHIFT  = self::class . '-shift';

    /**
     * @var def\Cipher\Alphabet\AlphabetInterface
     */
    private $alphabet;
    private $encoding;

    private $factor = 1;
    private $shift  = 0;

    public function __construct(AlphabetInterface $alphabet, ContextInterface $context = null)
    {
        $this->alphabet = $alphabet;

        $this->encoding = mb_detect_encoding($alphabet->toString()) ?: mb_internal_encoding();

        if (isset($context)) {
            if ($context->exists(self::CONTEXT_KEY_FACTOR)) {
                $factor = $context->get(self::CONTEXT_KEY_FACTOR);

                if (is_int($factor)) {
                    $factor = $factor % $alphabet->getLength();

                    if ($factor < 0) {
                        $factor += $alphabet->getLength();
                    }

                    if (!coprime($alphabet->getLength(), $factor)) {
                        throw new InvalidArgumentException(
                            sprintf(
                                "Cipher factor (%d) and alphabet length (%d) need to be coprime",
                                $factor,
                                $alphabet->getLength()
                            )
                        );
                    }

                    $this->factor = $factor;
                }
            }

            if ($context->exists(self::CONTEXT_KEY_SHIFT)) {
                $shift = $context->get(self::CONTEXT_KEY_SHIFT);


                if (is_int($shift)) {
                    $shift = $shift % $alphabet->getLength();

                    if ($shift < 0) {
                        $shift += $alphabet->getLength();
                    }

                    $this->shift = $shift;
                }
            }
        }
    }

    public function encode(string $string) : string
    {
        $chars = [];

        foreach (preg_split("//u", $string, -1, PREG_SPLIT_NO_EMPTY) as $char) {
            $chars[] = $this->substitute($char);
        }

        return implode($chars);
    }

    public function decode(string $code) : string
    {
        $context = new Context([
            self::CONTEXT_KEY_FACTOR => $rfactor = inverse($this->factor, $this->alphabet->getLength()),
            self::CONTEXT_KEY_SHIFT  => -$rfactor * $this->shift,
        ]);

        return (new self($this->alphabet, $context))->encode($code);
    }

    public function substitute(string $letter) : string
    {
        $lowercase = mb_strtolower($letter, $this->encoding);

        if (!$this->alphabet->isLetter($lowercase)) {
            return $letter;
        }

        $code = $this->alphabet->getLetterCode($lowercase);
        $code = ($code * $this->factor + $this->shift) % $this->alphabet->getLength();

        $newLetter = $this->alphabet->getLetter($code);

        return $lowercase == $letter ? $newLetter : mb_strtoupper($newLetter, $this->encoding);
    }

    public function crack(string $code) : string
    {
        throw new BadMethodCallException("Not implemented yet");
    }

    public function getAlphabet() : AlphabetInterface
    {
        return $this->alphabet;
    }
}
