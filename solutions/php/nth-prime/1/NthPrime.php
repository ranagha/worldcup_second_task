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

function prime(int $number)
{
    if($number === 0) {
        return 0;
    }
    $prime = 2;
    for($i = 1; $i < $number; $i++) {
        $prime = nextPrime($prime);
    }
    return $prime;
}

function nextPrime($number) {
    $result = 0;
    $i = $number + 1;
    while (true) {
       if(isPrime($i)) {
           return $i;
       } 
       $i++; 
    }
}


function isPrime($number) {
    for($i = 2; $i <= $number/2; $i++) {
        if($number%$i === 0) {
            return false;
        }
    }
    return true;
}
