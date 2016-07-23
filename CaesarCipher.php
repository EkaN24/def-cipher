<?php
namespace def\Cipher;

use def\Cipher\Alphabet\AlphabetInterface;
use def\Cipher\Context\ContextInterface;
use def\Cipher\Context\Context;

class CaesarCipher extends LinearSubstitutionCipher
{
    const CONTEXT_KEY_SHIFT = self::class . '-shift';

    public function __construct(AlphabetInterface $alphabet, ContextInterface $context = null)
    {
        $shift = 0;

        if (isset($context)) {
            if ($context->exists(parent::CONTEXT_KEY_SHIFT)) {
                $shift = $context->get(parent::CONTEXT_KEY_SHIFT);
            }

            if ($context->exists(self::CONTEXT_KEY_SHIFT)) {
                $shift = $context->get(self::CONTEXT_KEY_SHIFT);
            }
        }

        $context = new Context([
            parent::CONTEXT_KEY_FACTOR => 1,
            parent::CONTEXT_KEY_SHIFT => $shift,
        ]);

        parent::__construct($alphabet, $context);
    }
}
