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

class ZebraPuzzle
{
    
    private array $colors;
    private array $nationalities;
    private array $pets;
    private array $hobbies;
    private array $drinks;
    private ?array $solution;
    
    public function __construct() {
        $this->colors = ['red', 'green', 'ivory', 'yellow', 'blue'];
        $this->nationalities = ['norwegian', 'english', 'ukrainian', 'spanish', 'japanese'];
        $this->drinks = ['coffee', 'tea', 'milk', 'orange juice', 'water'];
        $this->hobbies = ['dancing', 'painter', 'chess', 'reading', 'plays football'];
        $this->pets = ['zebra', 'dog', 'snail', 'horse', 'fox'];
        $this->solution = null;
    }

private function solve(): array
{
    if ($this->solution !== null) {
        return $this->solution;
    }

    $resultado = [
        'colors' => array_fill(0, 5, null),
        'nations' => array_fill(0, 5, null),
        'drinks' => array_fill(0, 5, null),
        'pets' => array_fill(0, 5, null),
        'hobbies' => array_fill(0, 5, null),
    ];

    // asignaciones fijas
    $resultado['drinks'][2] = 'milk';         // middle house
    $resultado['nations'][0] = 'norwegian';  // first house
    $resultado['colors'][1] = 'blue';        // por la pista del vecino

    // llama a la función recursiva de colores
    $this->backtrackColors(0, $resultado, ['blue']);

    return $this->solution;
}

private function backtrackColors(int $pos, array $state, array $usedColors)
{
    if ($this->solution !== null) {
        return;
    }
    if ($pos === 5) {
        // todas las casas tienen color, pasamos a naciones
        $this->backtrackNations(0, $state, ['norwegian']);
        return;
    }

    // si ya hay color fijo, saltamos esta posición
    if ($state['colors'][$pos] !== null) {
        $this->backtrackColors($pos + 1, $state, $usedColors);
        return;
    }

    foreach ($this->colors as $color) {
        if (in_array($color, $usedColors)) continue;

        $state['colors'][$pos] = $color;
        $newUsed = array_merge($usedColors, [$color]);

        if ($this->isValidState($state)) {
            $this->backtrackColors($pos + 1, $state, $newUsed);
        }

        // backtrack
        $state['colors'][$pos] = null;
    }
}

private function backtrackNations(int $pos, array $state, array $usedNations)
{
    if ($this->solution !== null) {
        return;
    }
    if ($pos === 5) {
        $this->backtrackDrinks(0, $state, ['milk']);
        return;
    }

    if ($state['nations'][$pos] !== null) {
        $this->backtrackNations($pos + 1, $state, $usedNations);
        return;
    }

    foreach ($this->nationalities as $nation) {
        if (in_array($nation, $usedNations)) continue;

        $state['nations'][$pos] = $nation;
        $newUsed = array_merge($usedNations, [$nation]);

        if ($this->isValidState($state)) {
            $this->backtrackNations($pos + 1, $state, $newUsed);
        }

        $state['nations'][$pos] = null;
    }
}

    private function backtrackDrinks(int $pos, array $state, array $usedDrinks)
    {
        if ($this->solution !== null) {
            return;
        }
        if ($pos === 5) {
            $this->backtrackPets(0, $state, []);
            return;
        }
    
        if ($state['drinks'][$pos] !== null) {
            $this->backtrackDrinks($pos + 1, $state, $usedDrinks);
            return;
        }
    
        foreach ($this->drinks as $drink) {
            if (in_array($drink, $usedDrinks)) continue;
    
            $state['drinks'][$pos] = $drink;
            $newUsed = array_merge($usedDrinks, [$drink]);
    
            if ($this->isValidState($state)) {
                $this->backtrackDrinks($pos + 1, $state, $newUsed);
            }
    
            $state['drinks'][$pos] = null;
        }
    }

    private function backtrackPets(int $pos, array $state, array $usedPets)
    {
        if ($this->solution !== null) {
            return;
        }
        if ($pos === 5) {
            $this->backtrackHobbies(0, $state, []);
            return;
        }
    
        if ($state['pets'][$pos] !== null) {
            $this->backtrackPets($pos + 1, $state, $usedPets);
            return;
        }
    
        foreach ($this->pets as $pet) {
            if (in_array($pet, $usedPets)) continue;
    
            $state['pets'][$pos] = $pet;
            $newUsed = array_merge($usedPets, [$pet]);
    
            if ($this->isValidState($state)) {
                $this->backtrackPets($pos + 1, $state, $newUsed);
            }
    
            $state['pets'][$pos] = null;
        }
    }

    private function backtrackHobbies(int $pos, array $state, array $usedHobbies)
    {
        if ($this->solution !== null) {
            return;
        }
        if ($pos === 5) {
            $this->solution = $state;
            return;
        }
    
        if ($state['hobbies'][$pos] !== null) {
            $this->backtrackHobbies($pos + 1, $state, $usedHobbies);
            return;
        }
    
        foreach ($this->hobbies as $hobby) {
            if (in_array($hobby, $usedHobbies)) continue;
    
            $state['hobbies'][$pos] = $hobby;
            $newUsed = array_merge($usedHobbies, [$hobby]);
    
            if ($this->isValidState($state)) {
                $this->backtrackHobbies($pos + 1, $state, $newUsed);
            }
    
            $state['hobbies'][$pos] = null;
        }
    }

    private function isValidState(array $state) {
        return $this->condition6($state) &&
            $this->condition2($state) &&
            $this->condition4($state) &&
            $this->condition5($state) &&
            $this->condition3($state) &&
            $this->condition7($state) &&
            $this->condition8($state) &&
            $this->condition13($state) &&
            $this->condition14($state) &&
            $this->condition11($state) &&
            $this->condition12($state);
    }

    private function condition2(array $state): bool
    {
        $index1 = array_search('english', $state['nations']);
        $index2     = array_search('red', $state['colors']);

        if($index1 === false || $index2 === false) {
            return true;
        }
        
        if ( $index1 === $index2) {
            return true;
        }
        return false;
    }

    private function condition3(array $state): bool
    {
        $index1 = array_search('spanish', $state['nations']);
        $index2     = array_search('dog', $state['pets']);

        if($index1 === false || $index2 === false) {
            return true;
        }
        
        if ( $index1 === $index2) {
            return true;
        }
        return false;
    }

    private function condition4(array $state): bool
    {
        $index1 = array_search('green', $state['colors']);
        $index2     = array_search('coffee', $state['drinks']);

         if($index1 === false || $index2 === false) {
            return true;
        }
        if ($index1 === $index2) {
            return true;
        }
        return false;
    }

    private function condition5(array $state): bool
    {
        $index1 = array_search('ukrainian', $state['nations']);
        $index2     = array_search('tea', $state['drinks']);
        
        if($index1 === false || $index2 === false) {
            return true;
        }
        
        if ($index1 === $index2) {
            return true;
        }
        return false;
    }

    private function condition6(array $state): bool
    {
        $index1 = array_search('green', $state['colors']);
        $index2     = array_search('ivory', $state['colors']);
        
        if($index1 === false || $index2 === false) {
            return true;
        }
        if ($index1 === $index2 + 1) {
            return true;
        }
        return false;
    }

    private function condition7(array $state): bool
    {
        $index1 = array_search('snail', $state['pets']);
        $index2     = array_search('dancing', $state['hobbies']);

        if($index1 === false || $index2 === false) {
            return true;
        }
        if ($index1 === $index2) {
            return true;
        }
        return false;
    }

    private function condition8(array $state): bool
    {
        $index1 = array_search('yellow', $state['colors']);
        $index2     = array_search('painter', $state['hobbies']);

        if($index1 === false || $index2 === false) {
            return true;
        }
        
        if ($index1 === $index2) {
            return true;
        }
        return false;
    }

    private function condition11(array $state): bool
    {
        $index1 = array_search('reading', $state['hobbies']);
        $index2     = array_search('fox', $state['pets']);

        if($index1 === false || $index2 === false) {
            return true;
        }
        
        if (abs($index1 - $index2) === 1) {
            return true;
        }
        return false;
    }

    private function condition12(array $state): bool
    {
        $index1 = array_search('painter', $state['hobbies']);
        $index2     = array_search('horse', $state['pets']);

        if($index1 === false || $index2 === false) {
            return true;
        }
        
        if (abs($index1 - $index2) === 1) {
            return true;
        }
        return false;
    }

    private function condition13(array $state): bool
    {
        $index1 = array_search('plays football', $state['hobbies']);
        $index2     = array_search('orange juice', $state['drinks']);
        if($index1 === false || $index2 === false) {
            return true;
        }        
        if ($index1 === $index2) {
            return true;
        }
        return false;
    }

    private function condition14(array $state): bool
    {
        $index1 = array_search('chess', $state['hobbies']);
        $index2     = array_search('japanese', $state['nations']);
         if($index1 === false || $index2 === false) {
            return true;
        }       
        if ($index1 === $index2) {
            return true;
        }
        return false;
    }
    
    public function waterDrinker(): ?string
    {
        $state = $this->solve();
        print_r($state);
        $index = array_search('water', $state['drinks']);
        if($index !== false) {
            return ucfirst($state['nations'][$index]);    
        }
        return null;
    }

    public function zebraOwner(): ?string
    {
        $state = $this->solve();
        $index = array_search('zebra', $state['pets']);
        if($index !== false) {
            return ucfirst($state['nations'][$index]);    
        }
        return null;
    }
}
