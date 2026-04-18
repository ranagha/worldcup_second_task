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

class TwoBucket
{
    public int $numberOfActions = 1;
    public ?string $nameOfBucketWithDesiredLiters = null;
    public int $litersLeftInOtherBucket = 0;
    
    public function solve(int $sizeBucketOne, int $sizeBucketTwo, int $goal, string $startBucket)
    {
        $visited = [];
        $queue = [];
        if ($startBucket === "one") {
            $start = [$sizeBucketOne, 0];
        } else {
            $start = [0, $sizeBucketTwo];
        }
        
        $queue[] = [$start[0], $start[1], 1]; // 1 acción ya hecha
        $visited["{$start[0]},{$start[1]}"] = true;
        $front = 0;

        while ($front < count($queue)) {
            [$a, $b, $steps] = $queue[$front++];
        
            if ($this->checkStateIsSolution($a, $b, $goal)) {
                if ($a === $goal) {
                    $this->nameOfBucketWithDesiredLiters = "one";
                    $this->litersLeftInOtherBucket = $b;
                } else {
                    $this->nameOfBucketWithDesiredLiters = "two";
                    $this->litersLeftInOtherBucket = $a;
                }
                
                $this->numberOfActions = $steps;
                
                return $this;
            }
        
            foreach ($this->nextStates($a, $b, $sizeBucketOne, $sizeBucketTwo) as [$na, $nb]) {
                if ($this->isForbiddenState($na, $nb, $startBucket, $sizeBucketOne, $sizeBucketTwo)) {
                    continue;
                }
                $key = "$na,$nb";
        
                if (!isset($visited[$key])) {
                    $visited[$key] = true;
                    $queue[] = [$na, $nb, $steps + 1];
                }
            }
        }
        
        throw new Exception("solution not found");
    }

    private function checkStateIsSolution(int $a, int $b, int $goal): bool
    {
        return $a === $goal || $b === $goal;
    }

    private function nextStates($a, $b, $maxA, $maxB) {
        $states = [];
        $states[] = $this->emptyA($a, $b);
        $states[] = $this->emptyB($a, $b);
        $states[] = $this->fillA($a, $b, $maxA, $maxB);
        $states[] = $this->fillB($a, $b, $maxA, $maxB);
        $states[] = $this->turnAintoB($a, $b, $maxA, $maxB);
        $states[] = $this->turnBintoA($a, $b, $maxA, $maxB);
        
        return array_values(array_filter($states, fn($s) => $s !== null));
    }

    private function emptyA($a, $b) {
        if($a === 0) {
            return null;
        }
        return [0, $b];
    }

    private function emptyB($a, $b) {
        if($b === 0) {
            return null;
        }
        return [$a, 0];
    }

    private function fillA($a, $b, $maxA, $maxB) {
        if($a === $maxA) {
            return null;
        }
        return [$maxA, $b];
    }

    private function fillB($a, $b, $maxA, $maxB) {
        if($b === $maxB) {
            return null;
        }
        return [$a, $maxB];
    }

    private function turnAintoB($a, $b, $maxA, $maxB) {
        if ($a === 0 || $b === $maxB) {
            return null;
        }
    
        $amount = min($a, $maxB - $b);
    
        return [$a - $amount, $b + $amount];
    }

    private function turnBintoA($a, $b, $maxA, $maxB) {
        if ($b === 0 || $a === $maxA) {
            return null;
        }
    
        $amount = min($b, $maxA - $a);
    
        return [$a + $amount, $b - $amount];
    }

    private function isForbiddenState($a, $b, $startBucket, $maxA, $maxB): bool
    {
        if ($startBucket === "one") {
            return $a === 0 && $b === $maxB;
        } else {
            return $b === 0 && $a === $maxA;
        }
    }
}
