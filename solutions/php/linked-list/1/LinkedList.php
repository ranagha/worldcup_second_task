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

class LinkedList
{
    private array $list;
    
    public function __construct()
    {
        $this->list = [];
    }

    public function pop() {
        $lastElement = $this->list[count($this->list) - 1];
        $this->list = array_slice($this->list, 0, -1);
        return $lastElement;
    }

    public function push($element) {
        $this->list[] = $element;
    }

    public function shift() {
        $firstElement = $this->list[0];
        $this->list = array_slice($this->list, 1);
        return $firstElement;
    }

    public function unshift($element) {
        $this->list = [$element, ...$this->list];
    }

    public function count() {
        return count($this->list);
    }

    public function delete($element) {
        $temp = [];
        $found = false;
        foreach($this->list as $item) {
            if($item !== $element) {
                $temp[] = $item;
                
            } else {
                if(!$found) {
                    $found = true;    
                } else {
                    $temp[] = $item;
                }
            }
            
        }
        $this->list = $temp;
    }
}
