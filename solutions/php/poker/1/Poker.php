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

class Poker
{
    public array $bestHands = [];

    public function __construct(array $hands)
    {
        $this->bestHands = $this->calculateBestHands($hands);
    }

    public function calculateBestHands(array $hands) {
        $result = [];
        $discriminator = [];
        foreach($hands as $index => $hand) {
            $result[$index] = $this->calculateHand($hand);
            $discriminator[$index] = $this->calculateDiscriminator($hand)[0];
        }
        print_r($result);
        $bestHands = [];
        $bestHand = 0;
        foreach($result as $index => $line) {
            if($line >= $bestHand) {
                $bestHands[] = $index;
                $bestHand = $line;
            }
        }
        $bestHandsCleaned = [];
        foreach($bestHands as $hand) {
            if($bestHand === $result[$hand]) {
                $bestHandsCleaned[] = $hand;
            }
        }
        
        $bestDiscriminator = 0;
        $bestHandsDiscriminated = [];
        foreach($bestHandsCleaned as $hand) {
            if($discriminator[$hand] >= $bestDiscriminator) {
                $bestHandsDiscriminated[] = $hand;
                $bestDiscriminator = $discriminator[$hand];
            }
        }
        $bestHandsFinals = [];

        foreach($bestHandsDiscriminated as $hand) {
            if($bestDiscriminator === $discriminator[$hand]) {
                $bestHandsFinals[] = $hand;
            }
        }
        $discriminator = [];
        foreach($bestHandsFinals as $index => $hand) {
            $discriminator[$index] = $this->calculateDiscriminator($hands[$hand])[1];
        }
        $bestHandsv2 = [];
        $bestDiscriminator = 0;
        foreach($bestHandsFinals as $hand) {
            if($discriminator[$hand] > $bestDiscriminator) {
                $bestHandsv2 = [];
            }
            if($discriminator[$hand] >= $bestDiscriminator) {
                $bestHandsv2[] = $hand;
                $bestDiscriminator = $discriminator[$hand];
            }
        }

        $discriminator = [];
        foreach($bestHandsv2 as $index => $hand) {
            $discriminator[$index] = $this->calculateDiscriminator($hands[$hand])[2];
        }
        $bestHandsv3 = [];
        $bestDiscriminator = 0;
        foreach($bestHandsv2 as $hand) {
            if($discriminator[$hand] > $bestDiscriminator) {
                $bestHandsv3 = [];
            }
            if($discriminator[$hand] >= $bestDiscriminator) {
                $bestHandsv3[] = $hand;
                $bestDiscriminator = $discriminator[$hand];
            }
        }
                        
        $discriminator = [];
        foreach($bestHandsv3 as $index => $hand) {
            $discriminator[$index] = $this->calculateDiscriminator($hands[$hand])[3];
        }
        print_r($discriminator);
        $bestHandsv4 = [];
        $bestDiscriminator = 0;
        foreach($bestHandsv3 as $hand) {
            if($discriminator[$hand] > $bestDiscriminator) {
                $bestHandsv4 = [];
            }
            if($discriminator[$hand] >= $bestDiscriminator) {
                $bestHandsv4[] = $hand;
                $bestDiscriminator = $discriminator[$hand];
            }
        }
        
        $discriminator = [];
        foreach($bestHandsv4 as $index => $hand) {
            $discriminator[$index] = $this->calculateDiscriminator($hands[$hand])[4];
        }
        $bestHandsv5 = [];
        $bestDiscriminator = 0;
        foreach($bestHandsv4 as $hand) {
            if($discriminator[$hand] > $bestDiscriminator) {
                $bestHandsv5 = [];
            }
            if($discriminator[$hand] >= $bestDiscriminator) {
                $bestHandsv5[] = $hand;
                $bestDiscriminator = $discriminator[$hand];
            }
        }        
        $theResult = [];
        foreach($bestHandsv5 as $hand) {
            $theResult[] = $hands[$hand];
        }

print_r($theResult);
        return $theResult;
    }

    public function calculateHand(string $hand) {
        if($this->checkRoyaleStair($hand)) {
            return 10;
        }
        if($this->checkColorStair($hand)) {
            return 9;
        }
        if($this->checkPoker($hand)) {
            return 8;
        }
        if($this->checkFul($hand)) {
            return 7;
        }
        if($this->checkColor($hand)) {
            return 6;
        }
        if($this->checkStair($hand)) {
            return 5;
        }
        if($this->checkThree($hand)) {
            return 4;
        }
        if($this->checkTwoPair($hand)) {
            return 3;
        }
        if($this->checkPair($hand)) {
            return 2;
        }
        return 1;
    }

    public function checkRoyaleStair(string $hand) {
        if($this->calculateDiscriminator($hand)[0] !== 14) {
            return false;
        }
        if($this->checkColorStair($hand)) {
            return true;
        }
         return false;
    }

    public function checkColorStair(string $hand) {
        if(!$this->checkColor($hand)) {
            return false;
        }
        if($this->checkStair($hand)) {
            return true;
        }
        return false;
    }


    public function checkPoker(string $hand) {
        return $this->calculateMaxNumberEquals($hand) === 4;
    }

    public function calculateMaxNumberEquals($hand) {
        $handArray = explode(',', $hand);
        $thisCard = 0;
        $quantity = [];
        foreach($handArray as $card) {
            $thisCard = $this->getNumber($card);
            if(!isset($quantity[$thisCard])) {
               $quantity[$thisCard] = 0;
            } 
            $quantity[$thisCard]++;
        }
        return max($quantity);
    }

    public function checkFul(string $hand) {
        $handArray = explode(',', $hand);
        $thisCard = 0;
        $numbers = [];
        $lastStick = "";
        foreach($handArray as $card) {
            $number = $this->getNumber($card);
            if(!isset($numbers[$number])) {
               $numbers[$number] = 0;
            } 
            $numbers[$number]++;
        }
        if($this->calculateMaxNumberEquals($hand) !== 3) {
            return false;
        }
        $found = false;
        foreach($numbers as $quantity) {
            if($found && $quantity >= 2) {
                return true;
            }
            if(!$found && $quantity >= 2) {
                $found = true;
            }
        }
        return false;
    }


    public function checkColor(string $hand) {
        $handArray = explode(',', $hand);
        $thisCard = 0;
        $quantity = [];
        $lastStick = "";
        foreach($handArray as $card) {
            if($lastStick !== "" && $this->getStick($card) !== $lastStick) {
                return false;
            }
            $lastStick = $this->getStick($card);
        }
        return true;
    }


    public function checkStair(string $hand) {
        $handArray = explode(',', $hand);
        $thisCard = 0;
        $numbers = [];
        $lastStick = "";
        foreach($handArray as $card) {
            $numbers[] = $this->getNumber($card);
        }
        sort($numbers);
        $lastNumber = 0;
        if($numbers[4] === 14 && $numbers[0] === 2) {
            $numbers[4] = 1;
            sort($numbers);
        }
        foreach($numbers as $number) {
            if($lastNumber !== 0 && $lastNumber +1 !== $number) {
                return false;
            }
            $lastNumber = $number;
        }
        return true;
    }


    public function checkThree(string $hand) {
        return $this->calculateMaxNumberEquals($hand) === 3;
    }


    public function checkTwoPair(string $hand) {
        $handArray = explode(',', $hand);
        $thisCard = 0;
        $numbers = [];
        $lastStick = "";
        foreach($handArray as $card) {
            $number = $this->getNumber($card);
            if(!isset($numbers[$number])) {
               $numbers[$number] = 0;
            } 
            $numbers[$number]++;
        }
        if($this->calculateMaxNumberEquals($hand) !== 2) {
            return false;
        }
        $found = false;
        foreach($numbers as $quantity) {
            if($found && $quantity === 2) {
                return true;
            }
            if(!$found && $quantity === 2) {
                $found = true;
            }
        }
        return false;
    }


    public function checkPair(string $hand) {
        return $this->calculateMaxNumberEquals($hand) === 2;
    }


    public function calculateDiscriminator(string $hand) {
        $handArray = explode(',', $hand);
        $bestCard = [];
        
        foreach($handArray as $card) {
            $thisCard = $this->getNumber($card);
            
            $bestCard[] = $thisCard;
            
        }
        $count = array_count_values($bestCard);
        foreach($bestCard as $index => $number) {
            $bestCard[$index] = $number * $count[$number] * $count[$number];
        }
        rsort($bestCard);
        print_r($bestCard);
        return $bestCard;
    }

    public function getNumber(string $card) {
        if(is_numeric(substr($card, 0, strlen($card)-1))) {
            $thisCard = (int)substr($card, 0, strlen($card)-1);

        }
        if($card[0] === 'J') {
            $thisCard = 11;
        }
        if($card[0] === 'Q') {
            $thisCard = 12;
        }
        if($card[0] === 'K') {
            $thisCard = 13;
        }
        if($card[0] === 'A') {
            $thisCard = 14;
        }

        return $thisCard;
    }

    public function getStick(string $card) {
        return substr($card, -1);
    }
}
