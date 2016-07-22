<?php
namespace def\Cipher;

function gcd(int $a, int $b) : int
{
    while ($b != 0) {
        $d = $a;
        $a = $b;
        $b = $d % $b;
    }

    return $a;
}

function prime(int $a) : bool
{
    if ($a <= 1) {
        return false;
    }

    for ($i = 2; $i * $i <= $a; $i++) {
        if (0 == $a % $i) {
            return false;
        }
    }

    return true;
}

function coprime(int $a, int $b) : bool
{
    return 1 == gcd($a, $b);
}
