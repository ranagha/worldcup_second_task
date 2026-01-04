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

function smallest(int $min, int $max): array
{
    $value = $max*$max+1;
    $factors = [];
    for($i = $min; $i <= $max; $i++) {
        for($j = $min; $j <= $max; $j++) {
            if($i*$j <= $value && is_palindrome($i*$j)) {
                if($i*$j < $value) {
                    $factors = [];
                }
                $value = $i*$j;
                $factors[] = [$i, $j];
            }
        }
    }
    if($value === $max*$max+1) {
        throw new Exception("Not found");
    }
    return [$value, $factors];
}

function largest(int $min, int $max): array
{
    $value = 0;
    $factors = [];
    for($i = $min; $i <= $max; $i++) {
        for($j = $min; $j <= $max; $j++) {
            if($i*$j >= $value && is_palindrome($i*$j)) {
                if($i*$j > $value) {
                    $factors = [];
                }
                $value = $i*$j;
                if($i < $j) {
                    if(!in_array([$i, $j], $factors)) {
                        $factors[] = [$i, $j];        
                    }
                    
                } else {
                    if(!in_array([$j, $i], $factors)) {
                        $factors[] = [$j, $i];
                    }
                }
                
            }
        }
    }
    if($value === 0) {
        throw new Exception("Not found");
    }
    return [$value, $factors];
}

function is_palindrome(int $number) {
    return $number === (int)strrev((string) $number);
}
