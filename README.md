# def-cipher

[![Build Status](https://travis-ci.org/andrew-kamenchuk/def-cipher.svg?branch=master)](https://travis-ci.org/andrew-kamenchuk/def-cipher)
[![Latest Stable Vesrion](https://img.shields.io/packagist/v/def/cipher.svg)](https://packagist.org/packages/def/cipher)

```php
use def\Cipher\CaesarCipher;
use def\Cipher\Alphabet\EnglishAlphabet;

$rot13 = new CaesarCipher(new EnglishAlphabet, 13);

print $rot13->encode("Hello, world\n");
```

or

```
use def\Cipher\VigenereCipher;
use def\Cipher\Alphabet\EnglishAlphabet;

$cipher = new VigenereCipher(new EnglishAlphabet, "keyword");

print $cipher->encode("Hello, world\n");
```
