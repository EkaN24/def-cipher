# def-cipher

```php
use def\Cipher\CaesarCipher;
use def\Cipher\Alphabet\EnglishAlphabet;

$rot13 = new CaesarCipher(new EnglishAlphabet, 13);

print $rot13->encode("Hello, world\n");
```

