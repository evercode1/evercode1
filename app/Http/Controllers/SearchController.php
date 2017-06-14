<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queries\SearchQuery;


class SearchController extends Controller
{
    public function index(Request $request)
    {

        $keyword = $request->get('q');

        $posts = SearchQuery::sendData($keyword);

        $count = count($posts);

        return view('results.index', compact('posts', 'keyword', 'count'));


    }
}
