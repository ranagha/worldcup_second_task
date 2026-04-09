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

class KindergartenGarden
{
    private array $childs;
    private array $diagramA;
    private array $diagramB;
    private array $plants = [
        'G' => 'grass',
        'C' => 'clover',
        'R' => 'radishes',
        'V' => 'violets'
    ];
    
    public function __construct(string $diagram)
    {
        $this->childs = ['Alice', 'Bob', 'Charlie', 'David', 'Eve', 'Fred', 'Ginny', 'Harriet', 'Ileana', 'Joseph', 'Kincaid', 'Larry'];
        $diagramArray = explode("\n", $diagram);
        $this->diagramA = str_split($diagramArray[0]);
        $this->diagramB = str_split($diagramArray[1]);
    }

    public function plants(string $student): array
    {
        $index = array_search($student, $this->childs);
        return [
            $this->plants[$this->diagramA[$index*2]], 
            $this->plants[$this->diagramA[$index*2+1]], 
            $this->plants[$this->diagramB[$index*2]], 
            $this->plants[$this->diagramB[$index*2+1]]
        ];
    }
}
