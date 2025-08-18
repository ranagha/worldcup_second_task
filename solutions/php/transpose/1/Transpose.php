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

function transpose(array $input): array
{
    $result = [];
    $converted = [];
    $max_lenght = 0;
    foreach($input as $i => $fila) {
        $converted[] = str_split($fila);
        if(strlen($fila) > $max_lenght) {
            $max_lenght = strlen($fila);
        }
    }

    foreach($converted as $i => $fila) {
        while($i !== count($converted) - 1 && count($converted[$i]) < $max_lenght) {
            $converted[$i][] = " ";
        }
    }
    print_r($converted);
    foreach($converted as $i => $fila) {

        if(empty($fila)) {

            $result[] = "";
        }
        foreach($fila as $j => $caracter) {

            $result[$j][$i] = $caracter;
        }
    }
    print_r($result);
    $resultConverted = [];
    foreach($result as $i => $fila) {
        if(!is_array($fila))  {
            return [$fila];
        }
        if($i === count($result) -1 ) {
            $resultConverted[] = rtrim(implode("", $fila));
        } else {
            $resultConverted[] = implode("", $fila);    
        }
        
    }

    return $resultConverted;
}
