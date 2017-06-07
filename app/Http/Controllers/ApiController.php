<?php

namespace App\Http\Controllers;

use App\Queries\ArchivesQuery;
use App\Queries\FeaturedBookQuery;
use Illuminate\Http\Request;
use App\Queries\GridQueries\GridQuery;
use App\Queries\GridQueries\UserQuery;
use App\Queries\GridQueries\CategoryQuery;
use App\Queries\GridQueries\PostQuery;
use App\Queries\CategoryListQuery;
use App\Queries\GridQueries\BookQuery;
use App\Queries\GridQueries\BlogResourceQuery;
use App\Queries\GridQueries\ContentQuery;
use App\Queries\ContentListQuery;
use App\User;
use App\Post;
use App\Book;
use App\BlogResource;
use App\Content;


class ApiController extends Controller
{

    public function aboutData()
    {

        return Content::where('name', 'About')->first();


    }

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

    public function contentData(Request $request)
    {

        return GridQuery::sendData($request, new ContentQuery);

    }

    public function contentList()
    {

        return ContentListQuery::sendData();


    }

    public function featuredBook()
    {

        return FeaturedBookQuery::sendFeaturedBook();

    }

    public function postData(Request $request)
    {

        return GridQuery::sendData($request, new PostQuery);

    }

    public function signatureData()
    {

        return Content::where('name', 'Signature')->first();

    }

    public function totalBooks()
    {


        return Book::all()->count();


    }

    public function totalPosts()
    {


        return Post::all()->count();


    }

    public function totalResources()
    {


        return BlogResource::all()->count();

    }

    public function totalUsers()
    {


        return User::all()->count();


    }

    public function userData(Request $request)
    {

        return GridQuery::sendData($request, new UserQuery);

    }
}
