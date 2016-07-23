<?php
namespace def\Cipher\Test\Alphabet;

use def\Cipher\Alphabet\Alphabet;

class AlphabetTest extends AbstractAlphabetInterfaceTest
{
    private static $ukrainian = [
        'а', 'б', 'в', 'г', 'ґ', 'д','е', 'є', 'ж', 'з',
        'и', 'і', 'ї', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р',
        'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ь', 'ю', 'я',
    ];

    /**
     * {@inheritdoc}
     */
    public function getAlphabets()
    {
        return [
            [ new Alphabet(range('a', 'z')) ],
            [ new Alphabet(self::$ukrainian) ],
            [ new Alphabet([]) ],
            [ new Alphabet(range('d', 'f')) ],
        ];
    }
}
