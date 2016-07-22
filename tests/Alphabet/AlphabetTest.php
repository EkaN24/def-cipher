<?php
namespace def\Cipher\Test\Alphabet;

use def\Cipher\Alphabet\Alphabet;

class AlphabetTest extends AbstractAlphabetInterfaceTest
{
    private $alphabet;

    /**
     * {@inheritdoc}
     */
    public function getAlphabet()
    {
        return $this->alphabet ?? $this->alphabet = new Alphabet('a', 'z');
    }
}
