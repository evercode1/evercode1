<?php

namespace App\Http\Controllers;

use App\Queries\PostCountQuery;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth', 'admin']);

    }

    public function index()
    {

        $data = PostCountQuery::sendData();

       // dd($data);

        return view('admin.index', compact('data'));
    }
}
