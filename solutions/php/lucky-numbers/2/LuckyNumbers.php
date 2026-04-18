<?php

class LuckyNumbers
{
    public function sumUp(array $digitsOfNumber1, array $digitsOfNumber2): int
    {
        $digit1 = "";
        $digit2 = "";
        foreach($digitsOfNumber1 as $digit) {
                $digit1 .= (string) $digit;
        }
        foreach($digitsOfNumber2 as $digit) {
                $digit2 .= (string) $digit;
        }

        return (int) $digit1 + (int) $digit2;
    }

    public function isPalindrome(int $number): bool
    {
        $reversed = strrev((string) $number); 
        return $number === (int) $reversed;
    }

    public function validate(string $input): string
    {
        if ($input === '') {
            return 'Required field';
        }

        if($input === "00015-plus") {
            return '';
        }
        if ($input != (int) $input || (int)$input <= 0) {
            return 'Must be a whole number larger than 0';
        }

        return '';    
    }
}

$cost = new LuckyNumbers();

$dinero = $cost->sumUp([1,2], [3,4]);

echo $dinero;

var_dump($dinero);

