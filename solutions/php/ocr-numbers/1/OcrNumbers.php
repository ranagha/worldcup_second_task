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

function separateInNumbers(array $input) {
    $output = [];
    $divisions = strlen($input[0]) / 3;
    for($i = 0; $i < $divisions; $i++) {
        $number = [];
        foreach($input as $line) {
            $number[] = substr($line, 3*$i, 3);
        }
        $output[] = $number;
    }
    return $output;
}

function recognize(array $input): string
{
    $output = [];
    if(count($input) % 4 !== 0) {
        throw new InvalidArgumentException('Bad number of lines');
    }
    if(strlen($input[0]) % 3 !== 0) {
        throw new InvalidArgumentException('Bad number of columns');
    }
    $haveHat = false;
    $notOk = true;    
    $actualNumber = 0;
    $input = separateInNumbers($input);
    $chain = '';
    foreach($input as $number) {
        $added = false;
        $notOk = true; 
        $position = -1;
        foreach($number as $key => $line) {
            if($key%4 === 0) {
                $added = false;
                $position++;
                if(!isset($output[$position])) {
                    $output[$position] = '';    
                }
                
            }
            if($key%4 === 0 && $line=== " _ ") {
                $haveHat = true;
            }
            if($key%4 === 0 && $line=== "   ") {
                $haveHat = false;
            }
            if($key % 4 === 1 && !$haveHat && $line === "  |") {
                $notOk = false;
                $added = true;
                $output[$position] .= '1';
            } else if ($key % 4 === 1 && !$haveHat && $line === '|_|') {
                $notOk = false;
                $added = true;
                $output[$position] .= '4';
            }
            if($key % 4 === 1 && $haveHat) {
                if($line === ' _|') {
                    if($number[$key + 1] === '|_ ') {
                        $notOk = false;
                        $added = true;
                        $output[$position] .= '2';
                    }
                    if($number[$key + 1] === ' _|') {
                        $notOk = false;
                        $added = true;
                        $output[$position] .= '3';
                    }
                }
                if($line === '|_ ') {
                    if($number[$key + 1] === '|_|') {
                        $notOk = false;
                        $added = true;
                        $output[$position] .= '6';
                    }
                    if($number[$key + 1] === ' _|') {
                        $notOk = false;
                        $added = true;
                        $output[$position] .= '5';
                    }
                }
                if($line === '  |') {
                    $notOk = false;
                    $added = true;
                    $output[$position] .= '7';
                }
                if($line === '| |' && $number[$key + 1] === '|_|') {
                    $notOk = false;
                    $added = true;
                    $output[$position] .= '0';
                }
                if($line === '|_|' && $number[$key + 1] === '|_|') {
                    $notOk = false;
                    $added = true;
                    $output[$position] .= '8';
                }
                if($line === '|_|' && $number[$key + 1] === ' _|') {
                    $notOk = false;
                    $added = true;
                    $output[$position] .= '9';
                }
    
            }
            
            if($key % 4 >= 1 && $notOk && !$added) {
                 $output[$position] .= '?';
                 $added = true;
            }
        }
    }
    print_r($output);
    return implode(',', $output);
}
