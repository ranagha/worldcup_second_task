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

/**
 * Note: we expect the total in cents (1$ = 100 cents).
 
function total(array $items): int
{
    $basicPrice = 800;
    $howMany = count(array_unique($items));
    $repeated = count($items) - $howMany;
    if($howMany === 0) {
        return 0;
    }

    $groups = [];
    $nGroups = 0;
    foreach($items as $item) {
        for($i = 0; $i <= $nGroups; $i++) {
            if(!isset($groups[$nGroups])) {
                $groups[$nGroups] = [];
            }
            if(in_array($item, $groups[$nGroups])) {
                $nGroups++;
            } else {
                $groups[$nGroups][] = $item;
                break;
            }
        }
        $nGroups = 0;
    }
    print_r($groups);
    $totalDiscount = 0;
    foreach($groups as $group) {
        $howMany = count(array_unique($group));
        if($howMany === 1) {
            $totalDiscount += count($group) * $basicPrice;
            continue;
        }
        if($howMany === 2) {
            $discount = 5;
        }
        if($howMany === 3) {
            $discount = 10;
        }
        if($howMany === 4) {
            $discount = 20;
        }
        if($howMany === 5) {
            $discount = 25;
        }
        $totalWithOutDiscount = count($group) * $basicPrice;
        $totalDiscount += $totalWithOutDiscount - ((count($group) * $basicPrice * $discount) / 100); 
        
    }
    
    return $totalDiscount; 
    
}

     */


function total(array $items): int
{
    $price = 800;
    // descuentos en porcentaje entero para usar aritmética entera
    $discounts = [
        1 => 0,
        2 => 5,
        3 => 10,
        4 => 20,
        5 => 25
    ];

    $counts = array_count_values($items);
    ksort($counts);

    $memo = [];
    return minPrice($counts, $price, $discounts, $memo);
}

function minPrice(array $counts, int $price, array $discounts, array &$memo): int
{
    if (array_sum($counts) === 0) {
        return 0;
    }

    // clave única y ordenada para memo
    $parts = [];
    foreach ($counts as $k => $v) {
        $parts[] = $k . ':' . $v;
    }
    $key = implode(',', $parts);
    if (isset($memo[$key])) {
        return $memo[$key];
    }

    $min = PHP_INT_MAX;
    $unique = array_keys($counts);
    $maxGroupSize = min(5, count($unique)); // como máximo 5 distintos (regla del kata)

    // probamos todos los tamaños posibles de grupo
    for ($size = 1; $size <= $maxGroupSize; $size++) {
        // generamos todas las combinaciones de $unique de tamaño $size
        foreach (combinations($unique, $size) as $group) {
            // construimos newCounts restando 1 a cada tipo del grupo
            $newCounts = $counts;
            foreach ($group as $item) {
                if (--$newCounts[$item] === 0) {
                    unset($newCounts[$item]);
                }
            }

            // coste en enteros: price * size * (100 - discount) / 100
            $discountPercent = $discounts[$size] ?? 0;
            $groupCost = intdiv($price * $size * (100 - $discountPercent), 100);

            $total = $groupCost + minPrice($newCounts, $price, $discounts, $memo);
            if ($total < $min) {
                $min = $total;
            }
        }
    }

    // guardar y devolver
    return $memo[$key] = $min;
}

function combinations(array $arr, int $k): array
{
    $n = count($arr);
    if ($k === 0) return [[]];
    if ($k > $n) return [];
    $result = [];

    $indices = range(0, $k - 1);
    while (true) {
        // construir combinación actual
        $comb = [];
        foreach ($indices as $i) $comb[] = $arr[$i];
        $result[] = $comb;

        // incrementar índices
        $i = $k - 1;
        while ($i >= 0 && $indices[$i] === $i + $n - $k) $i--;
        if ($i < 0) break;
        $indices[$i]++;
        for ($j = $i + 1; $j < $k; $j++) {
            $indices[$j] = $indices[$j - 1] + 1;
        }
    }

    return $result;
}
