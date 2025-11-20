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

function translate(string $text): string
{
    $result = [];
    $words = explode(" ", $text);
    foreach ($words as $word) {
        $result[] = calculateWord($word);
    }
    return implode(" ", $result);
}

function calculateWord(string $text): string
{
    if(rule1($text)) {
        return $text."ay";
    }
    if(rule3($text)) {
        $firstConsonants = "";
        $rest = "";
        $ok = true;
        $uindex = -1;
        foreach(str_split($text) as $index => $element) {
            if($element === 'q' && $text[$index+1] === 'u') {
                $firstConsonants .= "qu";
                $uindex = $index+1;
            }
            else if($ok && rule2($element)) {
                $firstConsonants .= $element;
            } else {
                $ok = false;
                if($index !== $uindex) {
                    $rest .= $element;    
                }
                
            }
        }
        return $rest.$firstConsonants."ay";
    }
    if(rule4($text)) {
        $firstConsonants = "";
        $rest = "";
        $ok = true;
        foreach(str_split($text) as $element) {
            if($ok && $element !== 'y') {
                $firstConsonants .= $element;
            } else {
                $ok = false;
                $rest .= $element;
            }
        }
        if($firstConsonants !== "") {
            return $rest.$firstConsonants."ay";    
        }
        
    }
    if(rule2($text)) {
        $firstConsonants = "";
        $rest = "";
        $ok = true;
        foreach(str_split($text) as $element) {
            if($ok && rule2($element)) {
                $firstConsonants .= $element;
            } else {
                $ok = false;
                $rest .= $element;
            }
        }
        return $rest.$firstConsonants."ay";
    }

    return $text;
}

function rule1(string $text) {
    if($text[0] === 'a' || $text[0] === 'e' || $text[0] === 'i' || $text[0] === 'o' || $text[0] === 'u' || substr($text, 0, 2) === 'xr' || substr($text, 0, 2) === 'yt') {
        return true;    
    }
    return false;
}

function rule2(string $text) {
    if($text[0] !== 'a' && $text[0] !== 'e' && $text[0] !== 'i' && $text[0] !== 'o' && $text[0] !== 'u') {
        return true;
    }
    return false;
}

function rule3(string $text) {
    $added = "";
    for($i = 0; $i < strlen($text); $i++) {
        if($text[$i] !== 'a' && $text[$i] !== 'e' && $text[$i] !== 'i' && $text[$i] !== 'o' && $text[$i] !== 'u') {
            $added .= $text[$i];
        } else {
            return false;
        }
        if($text[$i] === 'q' && $text[$i+1] === 'u') {
            return true;
        }
    }
    return false;
}

function rule4(string $text) {
    $added = "";
    for($i = 0; $i < strlen($text); $i++) {
        if($text[$i] !== 'a' && $text[$i] !== 'e' && $text[$i] !== 'i' && $text[$i] !== 'o' && $text[$i] !== 'u') {
            $added .= $text[$i];
        } else {
            return false;
        }
        if($text[$i] === 'y') {
            return true;
        }
    }
    return false;
}