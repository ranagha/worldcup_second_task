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

function pascalsTriangleRows(int $rowCount)
{
    $start = 1;
    $result = [];
    for($i = 0; $i < $rowCount; $i++) {
        for($j = 0; $j <= $i; $j++) {
            if($j === 0) {
                $result[$i][] = $start;
            } else {
                if(isset($result[$i-1][$j-1]) && isset($result[$i-1][$j])) {
                    $result[$i][] = $result[$i-1][$j-1] + $result[$i-1][$j];
                } else {
                    $result[$i][] = $result[$i-1][$j-1];
                }
            }
        }
    }
    print_r($result);
    return $result;
}
