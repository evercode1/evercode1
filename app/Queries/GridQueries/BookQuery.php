<?php

namespace App\Queries\GridQueries;
use DB;
use App\Queries\GridQueries\Contracts\DataQuery;

class BookQuery implements DataQuery
{

    public function data($column, $direction)
    {

        $rows = DB::table('books')
                    ->select('id as Id',
                             'title as Title',
                             'author as Author',
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

        $rows = DB::table('books')
                ->select('id as Id',
                    'title as Title',
                    'author as Author',
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