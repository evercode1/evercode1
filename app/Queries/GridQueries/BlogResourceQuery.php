<?php

namespace App\Queries\GridQueries;
use DB;
use App\Queries\GridQueries\Contracts\DataQuery;

class BlogResourceQuery implements DataQuery
{

    public function data($column, $direction)
    {

        $rows = DB::table('blog_resources')
                    ->select('id as Id',
                             'title as Title',
                             'url as Url',
                             'is_featured as Featured',
                             DB::raw('DATE_FORMAT(created_at,
                             "%m-%d-%Y") as Created'))
                    ->orderBy($column, $direction)
                    ->paginate(5);

             return $rows;


    }

    public function filteredData($column, $direction, $keyword)
    {

        $rows = DB::table('blog_resources')
                ->select('id as Id',
                    'title as Title',
                    'url as Url',
                    'is_featured as Featured',
                         DB::raw('DATE_FORMAT(created_at,
                                 "%m-%d-%Y") as Created'))
                ->where('title', 'like', '%' . $keyword . '%')
                ->orderBy($column, $direction)
                ->paginate(5);

            return $rows;

    }

}