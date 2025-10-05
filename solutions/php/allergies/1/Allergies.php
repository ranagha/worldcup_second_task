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

class Allergies
{
    private int $score;
    
    public function __construct(int $score)
    {
        print("hola ". $score);
        $this->score = $score;
    }

    public function isAllergicTo(Allergen $allergen): bool
    {
        foreach ($this->potenciasDeDos($this->score) as $alergic) {
            if(2**$alergic === $allergen->getScore()) {
                return true;
            }
        }
        return false;
    }

    private function potenciasDeDos($num) {
        $bin = strrev(decbin($num)); // binario invertido
        $res = [];
    
        foreach (str_split($bin) as $pos => $bit) {
            if ($bit === '1') {
                $res[] = $pos;
            }
        }
    
        return $res;
    }


    public function getList(): array
    {
        $result = [];
        foreach ($this->potenciasDeDos($this->score) as $alergic) {
            if(2**$alergic <= 128) {
                $result[] = new Allergen(2**$alergic);    
            }
            
        }
        return $result;
    }
}

class Allergen
{
    public const EGGS = 1;
    public const PEANUTS = 2;
    public const SHELLFISH = 4;
    public const STRAWBERRIES = 8;
    public const TOMATOES = 16;
    public const CHOCOLATE = 32;
    public const POLLEN = 64;
    public const CATS = 128;

    private int $score;
    
    public function __construct(int $score)
    {
        $this->score = $score;
    }

        private function potenciasDeDos($num) {
        $bin = strrev(decbin($num)); // binario invertido
        $res = [];
    
        foreach (str_split($bin) as $pos => $bit) {
            if ($bit === '1') {
                $res[] = $pos;
            }
        }
    
        return $res;
    }

    public static function allergenList(): array
    {
        return [new self(self::EGGS), new self(self::PEANUTS), new self(self::SHELLFISH), new self(self::STRAWBERRIES), new self(self::TOMATOES), new self(self::CHOCOLATE), new self(self::POLLEN), new self(self::CATS)];
    }

    public function getScore(): int 
    {
        print_r($this->score);
        return $this->score;
    }
}
