<?php

namespace App\Http\Controllers;

use App\Queries\ArchivesQuery;
use Illuminate\Http\Request;
use App\Queries\GridQueries\GridQuery;
use App\Queries\GridQueries\UserQuery;
use App\Queries\GridQueries\CategoryQuery;
use App\Queries\GridQueries\PostQuery;
use App\Queries\CategoryListQuery;
use App\Queries\GridQueries\BookQuery;
use App\Queries\GridQueries\BlogResourceQuery;
use App\Category;
use App\Post;
use Carbon\Carbon;
use DB;

class ApiController extends Controller
{

    public function archives()
    {

        return ArchivesQuery::sendData();

    }

    public function blogResourceData(Request $request)
    {

        return GridQuery::sendData($request, new BlogResourceQuery);


    }

    public function bookData(Request $request)
    {

        return GridQuery::sendData($request, new BookQuery);

    }


    public function categoryData(Request $request)
    {

        return GridQuery::sendData($request, new CategoryQuery);

    }

    public function categoryList()
    {

        return CategoryListQuery::sendData();

    }

    public function featuredBook()
    {

        $book = config('book.promo-book');

        return json_encode($book);


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
