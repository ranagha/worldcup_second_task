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

class SpiralMatrix
{
    public function draw(int $n): array
    {
        $directions = [
            'right' => 'down',
            'down' => 'left',
            'left' => 'up',
            'up' => 'right'
        ];
        $result = $this->createEmptyArray($n);
        $direction = 'right';
        $top = 0;
        $bottom = $n - 1;
        $left = 0;
        $right = $n - 1;
        $it = 0;
        for($i = 0; $i < $n**2; $i++) {
            if($direction === 'right' && $it > $right-$left) {
                $direction = $directions[$direction];
                $top++;
                $it=0;
            }
            if($direction === 'down' && $it > $bottom-$top) {
                $direction = $directions[$direction];
                $right--;
                $it=0;
            }
            if($direction === 'left' && $it > $right-$left) {
                $direction = $directions[$direction];
                $bottom--;
                $it=0;
            }
            if($direction === 'up' && $it > $bottom-$top) {
                $direction = $directions[$direction];
                $left++;
                $it=0;
            }
            if($direction === 'right' && $it <= $right-$left) {
                $result[$top][$left + $it] = $i+1;
                $it++;
            }

            if($direction === 'down' && $it <= $bottom-$top) {
                $result[$it+$top][$right] = $i+1;
                $it++;
            }

            if($direction === 'left' && $it <= $right-$left) {
                $result[$bottom][$right-$it] = $i+1;
                $it++;
            }
            if($direction === 'up' && $it <= $bottom-$top) {
                $result[$bottom-$it][$left] = $i+1;
                $it++;
            }
        }

        return $result;
    }

    private function createEmptyArray(int $n) 
    {
        $result = [];
        for($i = 0; $i < $n; $i++) {
            for($j = 0; $j < $n; $j++) {
                $result[$i][$j] = 0;
            }
        }
        return $result;
    }
}
