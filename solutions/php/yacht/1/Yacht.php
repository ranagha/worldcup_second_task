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

class Yacht
{
    public function score(array $rolls, string $category): int
    {
        $solution = 0;
        switch($category) {
            case 'ones':
                $solution = $this->scoreNumbers($rolls, 1);
                break;
            case 'twos':
                $solution = $this->scoreNumbers($rolls, 2);
                break;
            case 'threes':
                $solution = $this->scoreNumbers($rolls, 3);
                break;
            case 'fours':
                $solution = $this->scoreNumbers($rolls, 4);
                break;
            case 'fives':
                $solution = $this->scoreNumbers($rolls, 5);
                break;
            case 'sixes':
                $solution = $this->scoreNumbers($rolls, 6);
                break;
            case 'full house':
                $solution = $this->calculeFullHouse($rolls);
                break;
            case 'four of a kind':
                $solution = $this->calculeFour($rolls);
                break;
            case 'little straight':
                $solution = $this->calculeLittle($rolls);
                break;
            case 'big straight':
                $solution = $this->calculeBig($rolls);
                break;
            case 'choice':
                $solution = $this->calculeChoice($rolls);
                break;
            case 'yacht':
                $solution = $this->calculeYacht($rolls);
                break;
            default: 
        }
        return $solution;
    }

    private function calculeLittle(array $rolls) {
        sort($rolls);
        if($rolls[0] === 1 && $rolls[1] === 2 && $rolls[2] === 3 && $rolls[3] === 4 && $rolls[4] === 5) {
            return 30;
        }
        return 0;
    }

    private function calculeBig(array $rolls) {
        sort($rolls);
        if($rolls[0] === 2 && $rolls[1] === 3 && $rolls[2] === 4 && $rolls[3] === 5 && $rolls[4] === 6) {
             return 30;   
        }
        return 0;
    }

    private function calculeChoice(array $rolls) {
        $value = 0;
        foreach($rolls as $roll) {
            $value += $roll;
        }
        return $value;
    }

    private function calculeYacht(array $rolls) {
        $value = $rolls[0];
        foreach($rolls as $roll) {
            if($value !== $roll) {
                return 0;
            }
        }
        return 50;
    }

    private function scoreNumbers(array $rolls, int $n) {
        return array_sum(array_filter($rolls, fn($elem) => $elem === $n));
    }

    private function calculeFullHouse(array $rolls) {
        if($this->isFullHouse($rolls)) {
            return array_sum($rolls);    
        }
        return 0;
    }

    private function calculeFour(array $rolls) {
        $grupped = [];
        foreach($rolls as $roll) {
            if(!isset($grupped[$roll])) {
                $grupped[$roll] = 0;
            }
            $grupped[$roll]++;
        }
        foreach($grupped as $number => $value) {
            if($value >= 4) {
                return 4*$number;
            }
        }
        return 0;
    }

    private function isFullHouse($rolls) {
        $grupped = [];
        foreach($rolls as $roll) {
            if(!isset($grupped[$roll])) {
                $grupped[$roll] = 0;
            }
            $grupped[$roll]++;
        }
        if(count($grupped) > 2 || count($grupped) < 1)  {
            return false;
        }
        $first=array_pop($grupped);
        if($first > 3 || $first < 2) {
            return false;
        }
        return true;
    }

    
}
