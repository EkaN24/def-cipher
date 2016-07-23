<?php
namespace def\Cipher\Alphabet;

class EnglishAlphabet extends Alphabet
{
    public function __construct()
    {
        parent::__construct(range('a', 'z'));
    }
}
