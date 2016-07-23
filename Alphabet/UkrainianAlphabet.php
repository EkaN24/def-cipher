<?php
namespace def\Cipher\Alphabet;

class UkrainianAlphabet extends Alphabet
{
    public function __construct()
    {
        parent::__construct([
            'а', 'б', 'в', 'г', 'ґ', 'д','е', 'є', 'ж', 'з',
            'и', 'і', 'ї', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р',
            'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ь', 'ю', 'я',
        ]);
    }
}
