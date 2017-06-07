<?php

namespace App\Queries\GridQueries;
use DB;
use App\Queries\GridQueries\Contracts\DataQuery;

class ContentQuery implements DataQuery
{

    public function data($column, $direction)
    {

        $rows = DB::table('contents')
                    ->select('id as Id',
                             'name as Name',
                             DB::raw('DATE_FORMAT(created_at,
                             "%m-%d-%Y") as Created'))
                    ->orderBy($column, $direction)
                    ->paginate(5);

             return $rows;


    }

    public function filteredData($column, $direction, $keyword)
    {

        $rows = DB::table('contents')
                ->select('id as Id',
                    'name as Name',
                    DB::raw('DATE_FORMAT(created_at,
                                 "%m-%d-%Y") as Created'))
                ->where('title', 'like', '%' . $keyword . '%')
                ->orderBy($column, $direction)
                ->paginate(5);

            return $rows;

    }

}