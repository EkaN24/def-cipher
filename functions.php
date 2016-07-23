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

function gcdr(int $a, int $b)
{
    if ($b == 0) {
        return $a;
    }

    return gcdr($b, $a % $b);
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

/**
 * https://en.wikipedia.org/wiki/Extended_Euclidean_algorithm#Modular_integers
 */
function inverse(int $a, int $b) : int
{
    list($t, $newt) = [0, 1];
    list($r, $newr) = [$b, $a];

    while ($newr != 0) {
        $q = intdiv($r, $newr);
        list($t, $newt) = [$newt, $t - $q * $newt];
        list($r, $newr) = [$newr, $r - $q * $newr];
    }

    if ($r == 1) {
        return $t < 0 ? $t + $b : $t;
    }

    // make it fail
}
