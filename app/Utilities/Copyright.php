<?php

namespace App\Utilities;

class Copyright
{

    public static function displayNotice()
    {

        $date = date('Y') > 2017 ? date ('Y') : 2017;


        return '&copy ' . $date . ' <a href="/about">Bill Keck</a> All rights Reserved.';


    }

}