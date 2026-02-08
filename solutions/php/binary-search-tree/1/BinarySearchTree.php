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

class BinarySearchTree
{
    public ?BinarySearchTree $left;
    public ?BinarySearchTree $right;
    public int $data;

    public function __construct(int $data)
    {
        $this->data = $data;
        $this->left = null;
        $this->right = null;
    }
    
    public function insert(int $data)
    {
        if($this->left !== null && $data <= $this->data) {
            $this->left->insert($data);
        }
        if($this->right !== null && $data > $this->data) {
            $this->right->insert($data);
        }
        if($this->left === null && $data <= $this->data) {
            $this->left = new BinarySearchTree($data);
        }
        if($this->right === null && $data > $this->data) {
            $this->right = new BinarySearchTree($data);    
        }
    }

    public function getSortedData(): array
    {
        $left === null;
        $right === null;
        if($this->left !== null) {
            $left = $this->left->getSortedData();
        }
        if($this->right !== null) {
            $right = $this->right->getSortedData();
        }
        if($left !== null && $right !== null) {
            return [...$left, $this->data, ...$right];
        }
        if($left === null && $right !== null) {
            return [$this->data, ...$right];
        }
        if($left !== null && $right === null) {
            return [...$left, $this->data];
        }
        return [$this->data];
    }
}
