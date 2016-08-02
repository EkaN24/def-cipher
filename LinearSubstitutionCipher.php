<?php
namespace def\Cipher;

use def\Cipher\Alphabet\AlphabetInterface;
use def\Cipher\Context\ContextInterface;
use def\Cipher\Context\Context;
use InvalidArgumentException;
use BadMethodCallException;

/**
 * makes a linear substitution x -> a*x + b mod alphabet length
 */
class LinearSubstitutionCipher implements SubstitutionCipherInterface
{
    const CONTEXT_KEY_FACTOR = self::class . '-factor';
    const CONTEXT_KEY_SHIFT  = self::class . '-shift';

    /**
     * @var def\Cipher\Alphabet\AlphabetInterface
     */
    private $alphabet;

    /**
     * @var int
     */
    private $factor = 1;

    /**
     * @var int
     */
    private $shift  = 0;

    /**
     * {@inheritdoc}
     */
    public function __construct(AlphabetInterface $alphabet, ContextInterface $context = null)
    {
        $this->alphabet = $alphabet;

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

    /**
     * {@inheritdoc}
     */
    public function encode(string $string) : string
    {
        $chars = [];

        foreach (preg_split("//u", $string, -1, PREG_SPLIT_NO_EMPTY) as $char) {
            $chars[] = $this->substitute($char);
        }

        return implode($chars);
    }

    /**
     * {@inheritdoc}
     */
    public function decode(string $code) : string
    {
        $context = new Context([
            self::CONTEXT_KEY_FACTOR => $rfactor = inverse($this->factor, $this->alphabet->getLength()),
            self::CONTEXT_KEY_SHIFT  => -$rfactor * $this->shift,
        ]);

        return (new self($this->alphabet, $context))->encode($code);
    }

    /**
     * {@inheritdoc}
     */
    public function substitute(string $letter) : string
    {
        if (!$this->alphabet->isLetter($letter)) {
            return $letter;
        }

        $code = $this->alphabet->getLetterCode($letter);
        $code = ($code * $this->factor + $this->shift) % $this->alphabet->getLength();

        return $this->alphabet->getLetter($code);
    }

    /**
     * {@inheritdoc}
     */
    public function crack(string $code) : string
    {
        throw new BadMethodCallException("Not implemented yet");
    }

    /**
     * {@inheritdoc}
     */
    public function getAlphabet() : AlphabetInterface
    {
        return $this->alphabet;
    }
}
