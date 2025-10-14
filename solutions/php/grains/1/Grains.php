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

function bigPower($base, $exp) {
    $result = "1";
    for ($i = 0; $i < $exp; $i++) {
        $carry = 0;
        $newResult = "";
        for ($j = strlen($result) - 1; $j >= 0; $j--) {
            $prod = ((int)$result[$j]) * $base + $carry;
            $carry = intdiv($prod, 10);
            $newResult = ($prod % 10) . $newResult;
        }
        if ($carry > 0) $newResult = $carry . $newResult;
        $result = $newResult;
    }
    return $result;
}

function bigAdd(string $a, string $b): string {
    $a = ltrim($a, '0');
    $b = ltrim($b, '0');
    $a = $a === '' ? '0' : $a;
    $b = $b === '' ? '0' : $b;

    // Igualar longitudes rellenando con ceros a la izquierda
    $maxLen = max(strlen($a), strlen($b));
    $a = str_pad($a, $maxLen, '0', STR_PAD_LEFT);
    $b = str_pad($b, $maxLen, '0', STR_PAD_LEFT);

    $carry = 0;
    $result = '';

    // Sumar de derecha a izquierda
    for ($i = $maxLen - 1; $i >= 0; $i--) {
        $sum = (int)$a[$i] + (int)$b[$i] + $carry;
        $carry = intdiv($sum, 10);
        $result = ($sum % 10) . $result;
    }

    if ($carry > 0) {
        $result = $carry . $result;
    }

    return $result;
}

function square(int $number): string
{
    if($number < 1 || $number > 64) {
        throw new InvalidArgumentException('The number is not allowed');
    }

    return bigPower(2, $number-1);
}


function total(): string
{
    $acum = "0";
    for($i = 0; $i < 64; $i++) {
        $acum = bigAdd($acum, bigPower(2, $i));
    }
    return (string)$acum;
}
