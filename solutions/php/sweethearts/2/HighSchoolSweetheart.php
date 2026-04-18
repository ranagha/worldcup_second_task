<?php

class HighSchoolSweetheart
{
    public function firstLetter(string $name): string
    {
        return trim($name)[0];
    }

    public function initial(string $name): string
    {
        return strtoupper($this->firstLetter($name).".");
    }

    public function initials(string $name): string
    {
        $total = "";
        $array = explode(" ", $name);
        foreach ($array as $nam) { 
            $total .= $this->initial($nam)." ";
        }

        return trim($total);
    }

    public function pair(string $sweetheart_a, string $sweetheart_b): string
    {
        
return "     ******       ******
   **      **   **      **
 **         ** **         **
**            *            **
**                         **
**     ".$this->initials($sweetheart_a)."  +  ".$this->initials($sweetheart_b)."     **
 **                       **
   **                   **
     **               **
       **           **
         **       **
           **   **
             ***
              *";
        
    }
}
