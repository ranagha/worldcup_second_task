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

function say(int $number): string
{
    return numberLessThousand($number);
}

function numberLessThousand(int $number) {
    if($number < 0) {
        throw new InvalidArgumentException("Input out of range");
    }
    if($number > 999999999999) {
        throw new InvalidArgumentException("Input out of range");
    }
    if($number < 100) {
        return lessThanHundred($number);    
    }
    if($number < 1000) {
        return numberBeetweenHundredAndThousand($number);    
    }
    if($number < 1000000) {
        return numberBeetweenThousandAndMillion($number);        
    }
    if($number < 1000000000) {
        return numberBeetweenMillionAndBillion($number);    
    }
    return numberGigant($number);  
}

function numberGigant(int $number) {
    $thous = (int)floor($number / 1000000000);
    
    if($thous > 100) {
        $sol = numberBeetweenHundredAndThousand($thous).' billion';    
    }
    if($thous < 10) {
        $sol = basicNumbers($thous).' billion';
    }
    
    if($number - 1000000000*$thous > 0) {
        return $sol. ' ' . numberBeetweenMillionAndBillion($number-1000000000*$thous);    
    } 
    return $sol;
}

function numberBeetweenMillionAndBillion(int $number) {
    $thous = (int)floor($number / 1000000);
    if($thous > 100) {
        $sol = numberBeetweenHundredAndThousand($thous).' million';    
    }
    if($thous < 10) {
        $sol = basicNumbers($thous).' million';
    }
    if($number - 1000000*$thous > 0) {
        return $sol. ' ' . numberBeetweenThousandAndMillion($number-1000000*$thous);    
    } 
    return $sol;
}

function numberBeetweenThousandAndMillion(int $number) {
    $thous = (int)floor($number / 1000);
    if($thous > 100) {
        $sol = numberBeetweenHundredAndThousand($thous).' thousand';    
    }
    if($thous < 10) {
        $sol = basicNumbers($thous).' thousand';
    }
    if($number - 1000*$thous > 0) {
        return $sol. ' ' . numberBeetweenHundredAndThousand($number-1000*$thous);    
    } 
    return $sol;
}

function numberBeetweenHundredAndThousand(int $number) {
    $cents = (int)floor($number / 100);
    $sol = basicNumbers($cents).' hundred';
    if($number - 100*$cents > 0) {
        return $sol. ' ' . lessThanHundred($number-100*$cents);    
    } 
    return $sol;
}

function lessThanHundred(int $number) {
    if($number < 12) {
        return basicNumbers($number);    
    }
    if($number < 20) {
        return teens($number);
    }
    if($number < 100) {
        return decs($number);
    }
}

function decs(int $number) {
    $decsArr = [
        2 => 'twenty',
        3 => 'thirty',
        4 => 'forty',
        5 => 'fifty',
        6 => 'sixty',
        7 => 'seventy',
        8 => 'eighty',
        9 => 'ninety'
    ];
    $decs = floor($number / 10);

    $units = $number % 10;

    if($units > 0) {
        return $decsArr[$decs]."-".basicNumbers($units);    
    }
    return $decsArr[$decs];
}

function teens(int $number) {
    return basicNumbers($number-10).'teen';
}

function basicNumbers(int $number) {
    print_r($number."-");
    return match($number) {
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve'
    };
}
