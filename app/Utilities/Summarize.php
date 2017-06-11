<?php

namespace App\Utilities;

class Summarize
{
    public static function summary($string)
    {

        return substr($string, 0, 20) . '...';

    }


}

