<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;

class PagesController extends Controller
{
    public function index()
    {


        $posts = Post::latest()->where('is_published', 1)->simplePaginate(3);

        return view('pages.index', compact('posts'));

    }
}
