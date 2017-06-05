<?php

namespace App\Queries;

use Illuminate\Http\Request;
use App\Category;
use App\Posts;

class CategoryListQuery
{

    public static function sendData()
    {


        $categories = Category::with(['posts' => function ($query) {
            $query->where('is_published', '=', 1);
        }])->get();

        return json_encode($categories);



    }



}