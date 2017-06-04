<?php

namespace App\Queries\GridQueries;
use DB;
use App\Queries\GridQueries\Contracts\DataQuery;

class PostQuery implements DataQuery
{

    public function data($column, $direction)
    {

        $rows = DB::table('posts')
            ->select('posts.id as Id',
                'posts.title as Title',
                'users.name as Author',
                'posts.is_published as Status',
                'categories.name as Category',
                DB::raw('DATE_FORMAT(posts.created_at,
                                 "%m-%d-%Y") as Created'),
                DB::raw('DATE_FORMAT(posts.published_at,
                                 "%m-%d-%Y") as Published'))
            ->leftJoin('categories', 'category_id', '=', 'categories.id')
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->orderBy($column, $direction)
            ->paginate(5);

        return $rows;

    }

    public function filteredData($column, $direction, $keyword)
    {

        $rows = DB::table('posts')
            ->select('posts.id as Id',
                'posts.title as Title',
                'posts.is_published as Status',
                'users.name as Author',
                'categories.name as Category',
                DB::raw('DATE_FORMAT(posts.created_at,
                                 "%m-%d-%Y") as Created'),
                DB::raw('DATE_FORMAT(posts.published_at,
                                 "%m-%d-%Y") as Published'))
            ->leftJoin('categories', 'category_id', '=', 'categories.id')
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->where('posts.title', 'like', '%' . $keyword . '%')
            ->orWhere('categories.name', 'like', '%' . $keyword . '%')
            ->orderBy($column, $direction)
            ->paginate(5);

        return $rows;




    }

}