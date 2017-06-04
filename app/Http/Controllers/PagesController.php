<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;

class PagesController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $posts = Post::latest()->where('is_published', 1)->simplePaginate(4);

        return view('pages.index', compact('posts', 'categories'));

    }
}
