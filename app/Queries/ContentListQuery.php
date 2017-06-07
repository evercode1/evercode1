<?php

namespace App\Queries;

use DB;

class ContentListQuery
{
    public static function sendData()
    {
        $rows = DB::table('contents')
                ->select('id', 'name')
                ->orderBy('name', 'asc')
                ->get();

        return json_encode($rows);

    }

}