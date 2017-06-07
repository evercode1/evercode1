<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use Illuminate\Support\Facades\Redirect;

class ContentController extends Controller
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

        return view('content.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        return view('content.create');

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

            'name' => 'required|unique:contents|string|max:100',
            'body' => 'required|string|max:10000',
            'is_active' => 'required|boolean',

        ]);

        $content = Content::create([

            'name' => $request->name,
            'body' => $request->body,
            'is_active' => $request->is_active

        ]);



        $content->save();

        return Redirect::route('content.index');

    }


    public function show(Content $content)
    {


        return view('content.show', compact('content'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Content $content)
    {

        return view('content.edit', compact('content'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Content $content)
    {


        $this->validate($request, [

            'name' => 'required|string|max:100|unique:contents,name,' .$content->id,
            'body' => 'required|string|max:10000',
            'is_active' => 'required|boolean',

        ]);





        $content->update(['name' => $request->name,
                          'body'   => $request->body,
                          'is_active' => $request->is_active]);


        return Redirect::route('content.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Content::destroy($id);

        return Redirect::route('content.index');

    }
}

