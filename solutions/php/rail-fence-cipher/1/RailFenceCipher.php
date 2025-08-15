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

function encode(string $plainMessage, int $rails): string
{
    $railsArray = [];
    $message = str_split($plainMessage);
    
    $raili = -1;
    $direction = 1;
    foreach($message as $key => $letter) {
        if($direction === 1) {
            $raili = ++$raili;
            $railsArray[$raili][] = $letter;
                
        } else {
            $raili = --$raili;
            $railsArray[$raili][] = $letter;
            
        }
        if($direction === 1 && $raili === $rails -1) {
            $direction = 0;
        } if($direction === 0 && $raili === 0) {
            $direction = 1;
        }
    }
    
    $result = "";
    foreach ($railsArray as $rail) {
        $result .= implode("", $rail);
    }
    print_r($railsArray);
    return $result;
}

function decode(string $cipherMessage, int $rails): string
{
    $railsArray = [];
    $message = str_split($cipherMessage);

    $raili = -1;
    $direction = 1;
    foreach($message as $key => $letter) {
        if($direction === 1) {
            $raili = ++$raili;
            $railsArray[$raili][] = $letter;
                
        } else {
            $raili = --$raili;
            $railsArray[$raili][] = $letter;
            
        }
        if($direction === 1 && $raili === $rails -1) {
            $direction = 0;
        } if($direction === 0 && $raili === 0) {
            $direction = 1;
        }
    }

    $counts = [];
    for($i = 0; $i < $rails; $i++) {
        $counts[$i] = count($railsArray[$i]);
    }
    

    $railsGenerated = [];
    $offset = 0;
    $iterator = [];
    for($i = 0; $i < $rails; $i++) {
        $railsGenerated[$i] = str_split(substr($cipherMessage, $offset, $counts[$i]));
        $offset += $counts[$i];
        $iterator[$i] = 0;
        
    }

    $railsArray = [];
    $raili = -1;
    $direction = 1;
    foreach($message as $value) {
        if($direction === 1) {
            $raili = ++$raili;
            $railsArray[] = $railsGenerated[$raili][$iterator[$raili]];

        } else {
            $raili = --$raili;
            $railsArray[] = $railsGenerated[$raili][$iterator[$raili]];
        }
        $iterator[$raili]++;
        if($direction === 1 && $raili === $rails -1) {
            $direction = 0;
        } if($direction === 0 && $raili === 0) {
            $direction = 1;
        }
    }

    $result = implode("", $railsArray);
    
    print_r($railsGenerated);
    print_r($railsArray);
    return $result;
}
