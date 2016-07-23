<?php
namespace def\Cipher;

interface SubstitutionCipherInterface extends CipherInterface
{
    /**
     * substitute single letter
     * @param string letter, MUST be 1-length string
     * @return string letter, MUST be 1-length string
     */
    public function substitute(string $letter) : string;

    /**
     * cracks substitution cipher encoded string
     * @param string $code
     * @return string decoded
     */
    public function crack(string $code) : string;
}
