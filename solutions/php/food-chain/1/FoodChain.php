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

class FoodChain
{
    private $animals = [
            1 => [
                'name' => 'fly',
                'chain' => 'fly',
                'phrase' => 'I don\'t know why she swallowed the fly.'
            ],
            2 => [
                'name' => 'spider',
                'chain' => 'spider that wriggled and jiggled and tickled inside her',
                'phrase' => 'It wriggled and jiggled and tickled inside her.'
            ],
            3 => [
                'name' => 'bird',
                'chain' => 'bird',
                'phrase' => 'How absurd to swallow a bird!'
            ],
            4 => [
                'name' => 'cat',
                'chain' => 'cat',
                'phrase' => 'Imagine that, to swallow a cat!'
            ],
            5 => [
                'name' => 'dog',
                'chain' => 'dog',
                'phrase' => 'What a hog, to swallow a dog!'
            ],
            6 => [
                'name' => 'goat',
                'chain' => 'goat',
                'phrase' => 'Just opened her throat and swallowed a goat!'
            ],
            7 => [
                'name' => 'cow',
                'chain' => 'cow',
                'phrase' => 'I don\'t know how she swallowed a cow!'
            ],
        ];

    private $firstPhrase = 'I know an old lady who swallowed a ';
    
    public function verse(int $verseNumber): array
    {
        $verses = [];
        $verses[] = $this->firstPhrase. $this->animals[$verseNumber]['name'].'.';
        $verses[] = $this->animals[$verseNumber]['phrase'];
        if($verseNumber === 8) {
            return [
                'I know an old lady who swallowed a horse.',
                'She\'s dead, of course!'
            ];
        }
        for($i = $verseNumber; $i >=0; $i--) {
            if($i > 1) {
                $verses[] = 'She swallowed the '. $this->animals[$i]['name'] . ' to catch the ' .$this->animals[$i - 1]['chain'] . ".";    
            }
            
        }
        if($verseNumber > 1) {
            $verses[] = $this->animals[1]['phrase'];    
        } 
        $verses[count($verses)-1] .= ' Perhaps she\'ll die.';
        return $verses;
    }

    public function verses(int $start, int $end): array
    {
        $solution = [];
        for($i = $start; $i <= $end; $i++) {
            $verses = $this->verse($i);
            foreach($verses as $verse) {
                $solution[] = $verse;    
            }
            if($i < $end) {
                $solution[] = '';    
            }
        }
        return $solution;
    }

    public function song(): array
    {
        return $this->verses(1, 8);
    }
}
