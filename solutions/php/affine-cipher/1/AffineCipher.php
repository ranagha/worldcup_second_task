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

function encode(string $text, int $num1, int $num2): string
{
    $coprimes = [2, 4, 6, 8, 10, 12, 13, 14, 16, 18, 20, 22, 24];
    if(in_array($num1, $coprimes)) {
        throw new Exception("Be careful with coprimes");
    }
    $result = "";
    $round = 0;
    foreach(str_split(strtolower($text)) as $caracter) {
        if($round === 5) {
            $result .= " ";
            $round = 0;
        }
        if(is_numeric($caracter)) {
            $result .= $caracter;
        }
        else if(!ctype_alpha($caracter)) {
            continue;
        }
        else {
            $result .= chr((($num1*(ord($caracter) - ord('a')) +$num2) % 26) + ord('a'));    
        }
        $round++;
    }
    
    return trim($result);
}

function decode(string $text, int $num1, int $num2): string
{
    $result = "";

    if (gcd($num1, 26) !== 1) {
        throw new Exception("a y m no son coprimos, no existe inverso");
    }

    $a_inv = modInverse($num1, 26);

    foreach (str_split(strtolower($text)) as $caracter) {
        if ($caracter !== ' ') {
            if (is_numeric($caracter)) {
                $result .= $caracter;
            } else {
                $y = ord($caracter) - ord('a');
                $decoded = mod($a_inv * mod($y - $num2, 26), 26);
                $result .= chr($decoded + ord('a'));
            }
        }
    }
    return $result;
}

function modInverse($a, $m) {
    $a = $a % $m;
    for ($x = 1; $x < $m; $x++) {
        if (($a * $x) % $m == 1) {
            return $x;
        }
    }
    return null; // No existe inverso si no son coprimos
}

function gcd($a, $b) {
    return $b == 0 ? $a : gcd($b, $a % $b);
}

function mod($a, $m) {
    return ($a % $m + $m) % $m;
}
