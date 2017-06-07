<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Content;

class PagesController extends Controller
{
    public function index()
    {


        $posts = Post::latest()->where('is_published', 1)->simplePaginate(3);

        return view('pages.index', compact('posts'));

    }

    public function about()
    {

        $content = Content::where('name', 'About')->first();

        return view('content.show', compact('content'));


    }

    public function privacy()
    {

        $content = Content::where('name', 'Privacy Policy')->first();

        return view('content.show', compact('content'));


    }

    public function terms()
    {

        $content = Content::where('name', 'Terms Of Service')->first();

        return view('content.show', compact('content'));


    }
}
