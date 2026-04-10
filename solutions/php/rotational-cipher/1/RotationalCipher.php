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

class RotationalCipher
{
    public function rotate(string $text, int $shift): string
    {
        $array = str_split($text);
        $exitArray = [];
        $upper = false;
        foreach($array as $letter) {
            $upper = false;
            if(ctype_upper($letter)) {
                $upper = true;
                $letter = strtolower($letter);
            }
            if($letter === ' ' || ((int)$letter >= 0 && $letter <= 9)) {
                $exitArray[] = $letter;
            } else {
                if($upper) {
                    $exitArray[] = strtoupper(chr(((ord($letter) - ord('a') + $shift ) % 26) + ord('a')));        
                } else {
                    $exitArray[] = chr(((ord($letter) - ord('a') + $shift ) % 26) + ord('a'));        
                }
            }
            
        }
        return implode('', $exitArray);
    }
}
