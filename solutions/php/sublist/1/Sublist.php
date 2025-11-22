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

class Sublist
{
    public function compare(array $listOne, array $listTwo): string
    {
        $result = 'EQUAL';
        if(count($listOne) < count($listTwo)) {
            $result = 'SUBLIST';
        }
        if(count($listOne) > count($listTwo)) {
            $result = 'SUPERLIST';
        }

        $e = 0;

        
    // reemplaza todo lo relacionado con $e y el foreach por esto
    // comprobación estricta por longitudes y contenido contiguo
    if (count($listOne) === count($listTwo)) {
        // mismas longitudes: igualdad estricta
        $result = ($listOne === $listTwo) ? 'EQUAL' : 'UNEQUAL';
    } elseif (count($listOne) < count($listTwo)) {
        // posible SUBLIST: buscar listOne dentro de listTwo
        $found = false;
        $limit = count($listTwo) - count($listOne);
        for ($start = 0; $start <= $limit; $start++) {
            if (array_slice($listTwo, $start, count($listOne)) === $listOne) {
                $found = true;
                break;
            }
        }
        $result = $found ? 'SUBLIST' : 'UNEQUAL';
    } else {
        // count($listOne) > count($listTwo) -> posible SUPERLIST: buscar listTwo dentro de listOne
        $found = false;
        $limit = count($listOne) - count($listTwo);
        for ($start = 0; $start <= $limit; $start++) {
            if (array_slice($listOne, $start, count($listTwo)) === $listTwo) {
                $found = true;
                break;
            }
        }
        $result = $found ? 'SUPERLIST' : 'UNEQUAL';
    }
        return $result;
    }
}
