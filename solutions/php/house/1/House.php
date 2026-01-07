<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class House
{
    public function verse(int $verseNumber): array
    {
        $result = [];
        $start = "This is ";
        $end = "that lay in the house that Jack built.";
        $verses = [
            'that lay in the house that Jack built.',
            'that ate the malt',
            'that killed the rat',
            'that worried the cat',
            'that tossed the dog',
            'that milked the cow with the crumpled horn',
            'that kissed the maiden all forlorn',
            'that married the man all tattered and torn',
            'that woke the priest all shaven and shorn',
            'that kept the rooster that crowed in the morn',
            'that belonged to the farmer sowing his corn',
            'This is the horse and the hound and the horn'
        ];
        $object = $start.substr($verses[$verseNumber - 1], strpos($verses[$verseNumber - 1], "the"));
        $result[] = $object;
        for($i = $verseNumber -2; $i >= 0; $i--) {
            $result[] = $verses[$i];
        }
        return $result;
    }

    public function verses(int $start, int $end): array
    {
        $result = [];
        for($i = $start; $i <= $end; $i++) {
            $response = $this->verse($i);
            foreach($response as $element) {
                $result[] = $element;
            }
            $result[] = '';
        }
        array_pop($result);
        return $result;
    }
}
