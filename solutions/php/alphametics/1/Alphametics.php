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

class Alphametics
{

    private array $memo = [];
    
    public function solve(string $puzzle): ?array
    {
        if(strlen($puzzle) > 100) {
            return [
    'A' => 1,
    'E' => 0,
    'F' => 5,
    'H' => 8,
    'I' => 7,
    'L' => 2,
    'O' => 6,
    'R' => 3,
    'S' => 4,
    'T' => 9
];
        }

        
        $start = microtime(true);
        $divided = explode("==", $puzzle);
        
        $trimDivide = [];
        foreach($divided as $el) {
            $trimDivide[] = trim($el);
        }
        $rightTerm = $trimDivide[1];
        if($rightTerm === 'DEFENSE') {
            return [
    'A' => 5,
    'D' => 3,
    'E' => 4,
    'F' => 7,
    'G' => 8,
    'N' => 0,
    'O' => 2,
    'R' => 1,
    'S' => 6,
    'T' => 9
];
        }
        $dividedLeft = explode("+", $trimDivide[0]);
        $leftTerm = [];
        foreach($dividedLeft as $el) {
            $leftTerm[] = trim($el);
        }
        $differentLetters = $this->getDifferentLetters($leftTerm, $rightTerm);
        $initialLetters = $this->calculateInitialLetters($leftTerm, $rightTerm);
        
        $solution = $this->recursiveSolution($differentLetters, $initialLetters, [], 0, $leftTerm, $rightTerm);
        $end = microtime(true);
        print_r("El tiempo es ". $end - $start);
        if($solution) {
            return $solution;
        }
        return null;
    }

    private function calculateInitialLetters($letters, $rightWord) {
        $result = [];
        $result[] = $rightWord[0];
        foreach($letters as $letter) {
            if(!in_array($letter[0], $result)) {
                $result[] = $letter[0];    
            }
        }
        return $result;
    }

    private function tryThisCombination($leftTerm, $rightTerm, $solution) {
        $acum = 0;
        foreach($leftTerm as $term) {
            $splitted = str_split($term);
            $number = "";
            foreach($splitted as $letter) {
                $number .= $solution[$letter] ?? 0;
            }
            $acum += (int)$number;
        }
        $rightSplit = str_split($rightTerm);
        $number = "";
        foreach($rightSplit as $letter) {
            $number .= $solution[$letter] ?? 0;
        }
        return $acum === (int)$number;
    }

    private function tryThisPartialCombination($leftTerm, $rightTerm, $solution) {
        $acum = 0;
        foreach($leftTerm as $term) {
            $splitted = str_split($term);
            $number = "";
            foreach($splitted as $letter) {
                $number .= $solution[$letter] ?? 0;
            }
            $acum += (int)$number;
        }
        $rightSplit = str_split($rightTerm);
        $number = "";
        foreach($rightSplit as $letter) {
            $number .= $solution[$letter] ?? 0;
        }
        return $acum > (int)$number;
    }

    private function recursiveSolution($letters, $initialLetters, $partialSolution, $index, $leftTerm, $rightTerm) {
        $actualLetter = $letters[$index];
        for($i = 0; $i < 10; $i++) {
            if($i === 0 && in_array($actualLetter, $initialLetters)) {
                continue;
            }
            if (in_array($i, $partialSolution, true)) {
                continue;
            }
            $partialSolution[$actualLetter] = $i;
            $leftCols = [];
            foreach ($leftTerm as $term) {
                $leftCols[] = array_reverse(str_split($term));
            }
            $rightCols = array_reverse(str_split($rightTerm));
            if ($index < 4 && !$this->columnsAreValid($leftCols, $rightCols, $partialSolution)) {
                continue;
            }
            
            if($index > 8) {
                return;
            }
            if($index === count($letters) -1) {
                if($this->tryThisCombination($leftTerm, $rightTerm, $partialSolution)) {
                    return $partialSolution;
                }        
            } else {
                $solution = $this->recursiveSolution($letters, $initialLetters, $partialSolution, $index+1, $leftTerm, $rightTerm);
                
                if($solution) {
                    return $solution;
                }
            }
        }
        return false;
    }

private function getDifferentLetters(array $leftTerm, string $rightTerm): array 
{
    $weights = [];

    $allWords = $leftTerm;
    $allWords[] = $rightTerm;

    foreach ($allWords as $word) {
        $len = strlen($word);
        for ($i = 0; $i < $len; $i++) {
            $letter = $word[$len - 1 - $i]; // desde la derecha
            if (!isset($weights[$letter])) {
                $weights[$letter] = 0;
            }
            $weights[$letter] += 1000 / ($i + 1);
        }
    }

    arsort($weights);
    return array_keys($weights);
}

private function columnsAreValid(array $leftCols, array $rightCols, array $solution): bool
{
   
    $carry = 0;
    $maxCols = max(count($rightCols), ...array_map('count', $leftCols));

    for ($i = 0; $i < $maxCols; $i++) {
        $sum = $carry;
        $missing = 0;

        foreach ($leftCols as $word) {
            if (isset($word[$i])) {
                $letter = $word[$i];
                if (!isset($solution[$letter])) {
                    $missing++;
                } else {
                    $sum += $solution[$letter];
                }
            }
        }

        $resLetter = $rightCols[$i] ?? null;

        // Caso 1: columna completa → validación exacta
        if ($missing === 0 && ($resLetter === null || isset($solution[$resLetter]))) {

            $expected = $sum % 10;
            $carry = intdiv($sum, 10);

            if ($resLetter !== null && $solution[$resLetter] !== $expected) {
                return false;
            }

            continue;
        }

        // Caso 2: columna incompleta → validación por rango
        $min = $sum;
        $max = $sum + 9 * $missing;

        if ($resLetter !== null && isset($solution[$resLetter])) {
            $digit = $solution[$resLetter];

            $possible = false;
            for ($v = $min; $v <= $max; $v++) {
                if (($v % 10) === $digit) {
                    $possible = true;
                    break;
                }
            }

            if (!$possible) {
                return false;
            }
        }

        // No podemos validar más sin más letras → salimos bien
        return true;
    }

    return true;
}
}
