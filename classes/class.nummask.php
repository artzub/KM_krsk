<?php

class NumMask
{
    private $alphabet = "BSYAEGRQDJHNXWFKUPCVLMZOIT"; //"ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    function Decode($custom)
    {
        $len = strlen($this->alphabet);
        $clen= strlen($custom)-1;
        $result = 0;
        for($i=0; $i < strlen($custom); $i++)
        {
            for($j=0; $j < $len; $j++)
            {
                if($this->alphabet[$j] == $custom[$i])
                {
                    $result+=($j*pow($len,$clen));
                    $clen--;
                }
            }
         flush();
        }
        return $result;
    }

    function Encode($val)
    {
        $result = "";
        $k = $val;
        do
        {
            $div = (int)($k / strlen($this->alphabet));
            $mod = (int)($k % strlen($this->alphabet));
            $result .= $this->alphabet[$mod];
            $k = $div;
        } while((int)$div != 0);

        return strrev($result);
    }

}

?>
