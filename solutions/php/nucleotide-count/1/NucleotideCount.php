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

function nucleotideCount(string $input): array
{
    $a = 0;
    $c = 0;
    $g = 0;
    $t = 0;
    $inputArray = str_split($input);
    foreach($inputArray as $letter) {
        switch (strtolower($letter)) {
            case 'a':
                $a++;
                break;
            case 'c':
                $c++;
                break;
            case 'g':
                $g++;
                break;
            case 't':
                $t++;
                break;
            default:
                 throw new Exception("invalid");       
        }
    }
    return ['a' => $a, 'c' => $c, 't' => $t, 'g' => $g];
}
