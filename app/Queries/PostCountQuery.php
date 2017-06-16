<?php

namespace App\Queries;

use DB;

class PostCountQuery
{
    public static function sendData()
    {

        $data =[];

        $rows = DB::table('posts')
                ->select(
                'categories.name as category',

                DB::raw('COUNT(posts.id) as count'))
            ->leftJoin('categories', 'category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->orderBy('categories.name', 'asc')
            ->get();

        foreach($rows as $row){

            $data[$row->category] = $row->count;

        }



        return $data;

    }

}