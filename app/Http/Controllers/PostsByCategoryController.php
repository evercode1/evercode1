<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PostsByCategoryController extends Controller
{
    public function index($id)
    {

        $category = Category::where('id', $id)->pluck('name')->first();

        $posts = Post::live()->byCategory($id)->simplePaginate(1);;

        return view('posts-by-category.index', compact('posts', 'category'));

    }
}
