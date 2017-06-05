<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogResource;
use Illuminate\Support\Facades\Redirect;

class BlogResourceController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth', 'admin']);


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        return view('blog-resource.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        return view('blog-resource.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $this->validate($request, [

            'title' => 'required|unique:books|string|max:100',
            'url' => 'required|unique:books|string|max:100',
            'is_featured' => 'required|boolean',

        ]);

        $blogresource = BlogResource::create(['title' => $request->title,
                                      'url'   => $request->url,
                                      'is_featured' => $request->is_featured

        ]);

        $blogresource->save();

        return Redirect::route('blogresource.index');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(BlogResource $blogresource)
    {

        return view('blog-resource.edit', compact('blogresource'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, BlogResource $blogresource)
    {
        $this->validate($request, [

            'title' => 'required|string|max:40|unique:books,title,' .$blogresource,
            'url' => 'required|string|max:100|unique:books,url',
            'is_featured' => 'required|boolean',

        ]);



        $blogresource->update(['title' => $request->title,
                           'url'   => $request->url,
                           'is_featured' => $request->is_featured]);


        return Redirect::route('blogresource.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        BlogResource::destroy($id);

        return Redirect::route('blogresource.index');

    }
}

