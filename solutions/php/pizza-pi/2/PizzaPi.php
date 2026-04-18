<?php

class PizzaPi
{
    public function calculateDoughRequirement(int $pizzas, int $persons)
    {
        return $pizzas * (($persons * 20) + 200);
    }

    public function calculateSauceRequirement(int $pizzas, int $sauceCanVolume)
    {
        return $pizzas * 125 / $sauceCanVolume; 
    }

    public function calculateCheeseCubeCoverage(int $cheeseDimension, float $thickness, int $diameter)
    {
        return (int)($cheeseDimension**3 / ($thickness * 3.14 * $diameter));
    }

    public function calculateLeftOverSlices(int $pizzas, int $friends)
    {
        return (int)($pizzas*8%$friends); 
    }
}
