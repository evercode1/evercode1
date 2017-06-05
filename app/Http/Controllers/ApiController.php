<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queries\GridQueries\GridQuery;
use App\Queries\GridQueries\UserQuery;
use App\Queries\GridQueries\CategoryQuery;
use App\Queries\GridQueries\PostQuery;
use App\Category;
use App\Post;
use Carbon\Carbon;
use DB;

class ApiController extends Controller
{

    public function archives()
    {
        $archives = DB::table('posts')->select(DB::raw('Year(published_at) as year'),
            DB::raw('month(posts.published_at) as month'),
            DB::raw("count(posts.id) as `count`"))
            ->where('is_published', 1)
            ->groupBy('year', 'month')
            ->orderBy('published_at', 'desc')
            ->get();


        return json_encode($archives);



    }




    public function categoryData(Request $request)
    {

        return GridQuery::sendData($request, new CategoryQuery);

    }

    public function categoryList(Request $request)
    {

        $categories = Category::with(['posts' => function ($query) {
            $query->where('is_published', '=', 1);
        }])->get();

        return json_encode($categories);

    }

    public function postData(Request $request)
    {

        return GridQuery::sendData($request, new PostQuery);

    }

    public function userData(Request $request)
    {

        return GridQuery::sendData($request, new UserQuery);

    }
}
