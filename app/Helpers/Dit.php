<?php

namespace App\Helpers;

class Dit 
{


    public static function Rupiah($value)
    {

        if ($value > 0) {
			return "Rp. " . number_format($value, 2, ',', '.');
		} else {
			return "Rp. #N/A";
		}

    }

}