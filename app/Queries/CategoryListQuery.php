<?php

namespace App\Queries;

use Illuminate\Http\Request;
use App\Category;
use App\Posts;
use DB;

class CategoryListQuery
{

    public static function sendData()
    {

        return Category::withCount(['posts' => function ($query) {
            $query->where('is_published', '=', 1);
        }])->get();



    }



}