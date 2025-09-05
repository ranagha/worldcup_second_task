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

function vlq_encode(array $input): array
{
    $response = [];
    $i = 0;
    foreach($input as $number) {
        $mark = false;
        $responsei = [];
        if($number === 0) {
            $responsei[] = 0;
        }
        while ($number > 0) {
            $value = $number & 0x7F;
            if($mark) {
                $value += 128;
            }
            $responsei[] = $value;
            $number = $number >> 7;
            
            $mark = true;
        
        }
        $responsei = array_reverse($responsei);
        foreach($responsei as $value) {
            $response[$i] = $value;    
            $i++;
        }
        
    }
    return $response;
                        
}

function vlq_decode(array $input): array
{
    $result = [];
    $acum = 0;
    $bad = false;
    foreach($input as $key => $number) {
        $bad = true;
        $acum = ($acum << 7) | ($number & 0x7F);
        if ($acum > (0x7FFFFFFFF >> 7)) {
            throw new OverflowException("Número excede 32 bits");
        }
         if (($number & 0x80) === 0) {
            $result[] = $acum;

            $bad = false;
            $acum = 0; 
        }
    }
    if($bad) {
        throw new InvalidArgumentException('Number bad formed');
    }
    
    return $result;
}
