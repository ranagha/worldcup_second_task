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

class Tournament
{
    public function __construct()
    {
        
    }

    public function tally($scores)  
    {
        $points = [];
        $wins = [];
        $losses = [];
        $draws = [];
        $matches = [];
        $scoresArray = explode("\n", $scores);
        print_r($scoresArray);
        foreach($scoresArray as $match) {
            $matchArray = explode(';', $match);
            if(!isset($points[$matchArray[0]])) {
                $points[$matchArray[0]] = 0;
            }
            if(!isset($points[$matchArray[1]])) {
                $points[$matchArray[1]] = 0;
            }
            if(!isset($wins[$matchArray[0]])) {
                $wins[$matchArray[0]] = 0;
            }
            if(!isset($wins[$matchArray[1]])) {
                $wins[$matchArray[1]] = 0;
            }
            if(!isset($losses[$matchArray[0]])) {
                $losses[$matchArray[0]] = 0;
            }
            if(!isset($losses[$matchArray[1]])) {
                $losses[$matchArray[1]] = 0;
            }
            if(!isset($draws[$matchArray[0]])) {
                $draws[$matchArray[0]] = 0;
            }
            if(!isset($draws[$matchArray[1]])) {
                $draws[$matchArray[1]] = 0;
            }
            if(!isset($matches[$matchArray[0]])) {
                $matches[$matchArray[0]] = 0;
            }
            if(!isset($matches[$matchArray[1]])) {
                $matches[$matchArray[1]] = 0;
            }
            if($matchArray[2] === 'win') {
                $points[$matchArray[0]] += 3;
                $wins[$matchArray[0]] += 1;
                $losses[$matchArray[1]] += 1;
                $matches[$matchArray[0]] += 1;
                $matches[$matchArray[1]] += 1;
                
            }
            if($matchArray[2] === 'loss') {
                $points[$matchArray[1]] += 3;
                $wins[$matchArray[1]] += 1;
                $losses[$matchArray[0]] += 1;
                $matches[$matchArray[0]] += 1;
                $matches[$matchArray[1]] += 1;
            }
            if($matchArray[2] === 'draw') {
                $points[$matchArray[0]] += 1;
                $points[$matchArray[1]] += 1;
                $draws[$matchArray[0]] += 1;
                $draws[$matchArray[1]] += 1;
                $matches[$matchArray[0]] += 1;
                $matches[$matchArray[1]] += 1;
            }
            
        }
        $exit = "Team                           | MP |  W |  D |  L |  P";
        uksort($points, function ($keyA, $keyB) use ($points) {
    // 1) Comparamos valores en orden descendente:
    $compareValue = $points[$keyB] <=> $points[$keyA]; 
    // Si $array[$keyB] < $array[$keyA], dará -1, etc.
    // (<=> es el "spaceship operator")

    // 2) Si los valores son iguales ($compareValue === 0),
    // comparamos por clave en orden ascendente:
    if ($compareValue === 0) {
        return $keyA <=> $keyB; // clave menor va antes
    }

    return $compareValue;
});
        if($scores === '') {
            return $exit;
        }
        foreach($points as $team => $point) {
            $exit .= "\n" . $team . $this->spaces($team) . '|  ' . $matches[$team] . ' |  ' . $wins[$team] . ' |  ' . $draws[$team] . " |  " . $losses[$team] . " |  " . $points[$team];
        }
        return $exit;
    }

    private function spaces($team) {
        $exit = "";
        $nSpaces = 31 - strlen($team);
        for($i = 0; $i < $nSpaces; $i++) {
            $exit .= " ";
        }
        return $exit;
    }
}
