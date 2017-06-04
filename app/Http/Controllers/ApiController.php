<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queries\GridQueries\GridQuery;
use App\Queries\GridQueries\UserQuery;
use App\Queries\GridQueries\CategoryQuery;
use App\Queries\GridQueries\PostQuery;

class ApiController extends Controller
{
    public function userData(Request $request)
    {

        return GridQuery::sendData($request, new UserQuery);

    }

    public function categoryData(Request $request)
    {

        return GridQuery::sendData($request, new CategoryQuery);

    }

    public function postData(Request $request)
    {

        return GridQuery::sendData($request, new PostQuery);

    }
}
