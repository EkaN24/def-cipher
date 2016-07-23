# def-cipher

```php
use def\Cipher\CaesarCipher;
use def\Cipher\Context\Context;
use def\Cipher\Alphabet\EnglishAlphabet;

$rot13 = new CaesarCipher(new EnglishAlphabet, new Context([
    CaesarCipher::CONTEXT_KEY_SHIFT => 13,
]));

print $rot13->encode("Hello, world\n");
```

