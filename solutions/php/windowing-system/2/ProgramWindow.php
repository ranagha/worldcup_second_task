<?php

class ProgramWindow
{
    public $x, $y, $height, $width;

    public function __construct() {
        $this->x = 0;
        $this->y = 0;
        $this->height = 600;
        $this->width = 800;
        
    }

    public function resize(Size $size)
    {
        $this->height = $size->height; 
        $this->width = $size->width;
        
    }

    public function move(Position $position)
    {
        $this->x = $position->x;
        $this->y = $position->y;
        
    }
}

class Size 
{
    public $height, $width;

    public function __construct($height, $width) {
        $this->height = $height;
        $this->width = $width;
    }
        
}

class Position 
{
    public $x, $y;

    public function __construct($y, $x) {
        $this->x = $x;
        $this->y = $y;
    }
        
}

    
