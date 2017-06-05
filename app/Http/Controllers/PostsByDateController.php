<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;

class PostsByDateController extends Controller
{
    public function index($date)
    {



        $year = Carbon::parse($date)->format('Y');
        $month = Carbon::parse($date)->format('m');

        $posts = Post::live()
            ->byDate($year, $month)
            ->simplePaginate(2);


        return view('posts-by-date.index', compact('posts', 'date', 'year', 'month'));

    }
}
