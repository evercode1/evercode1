<?php

namespace App\Queries;

use DB;

class SearchQuery
{



    public static function sendData($keyword)
    {



        $rows = DB::table('posts')
                ->select('posts.id as Id',
                'posts.title as Title',
                'posts.body as Body',
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
                ->orWhere('posts.body', 'like', '%' . $keyword . '%')
                ->orWhere('categories.name', 'like', '%' . $keyword . '%')
                ->orderBy('id', 'asc')
                ->paginate(5);

        return $rows;




    }

}