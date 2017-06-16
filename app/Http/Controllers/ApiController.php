<?php

namespace App\Http\Controllers;

use App\ChartHelpers\PostPieChartBuilder;
use App\Queries\AlarmQuery;
use App\Queries\ArchivesQuery;
use App\Queries\FeaturedBookQuery;
use App\Queries\PostCountQuery;
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
use App\Queries\GridQueries\OpenContactQuery;
use App\Queries\GridQueries\ClosedContactQuery;
use App\User;
use App\Post;
use App\Book;
use App\Queries\GridQueries\ContactQuery;
use App\Queries\GridQueries\ContactTopicQuery;
use App\BlogResource;
use App\Content;
use App\Contact;
use App\ChartHelpers\BuildsCharts;



class ApiController extends Controller
{

    public function aboutData()
    {

        return Content::where('name', 'About')->first();


    }

    public function alarmData()
    {

        return AlarmQuery::sendData();


    }

    public function alarmSupportData()
    {

        $data = Contact::where('status_id', 1)->count();

        return json_encode($data);


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

    public function closedContactData(Request $request)
    {

        return GridQuery::sendData($request, new ClosedContactQuery);

    }

    public function contactData(Request $request)
    {

        return GridQuery::sendData($request, new ContactQuery);


    }

    public function contactTopicData(Request $request)
    {

        return GridQuery::sendData($request, new ContactTopicQuery);

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

    public function openContactData(Request $request)
    {

        return GridQuery::sendData($request, new OpenContactQuery);

    }

    public function pieChartData()
    {

        $data = new PostPieChartBuilder;


        return $data->getData();


    }

    public function postChartData(Request $request, BuildsCharts $chart)
    {

        return $chart->buildChart($request, ['posts']);


    }

    public function postData(Request $request)
    {

        return GridQuery::sendData($request, new PostQuery);

    }

    public function searchData(Request $request)
    {

        return Post::search($request->get('q'))->with('categories')->get();


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
