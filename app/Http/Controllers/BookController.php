<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
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

        return view('book.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        return view('book.create');

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
            'author' => 'required|string|max:100',
            'is_featured' => 'required|boolean',

        ]);

        $book = Book::create(['title' => $request->title,
                              'url'   => $request->url,
                              'author' => $request->author,
                              'is_featured' => $request->is_featured

        ]);

        $book->save();

        return Redirect::route('book.index');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Book $book)
    {

        return view('book.edit', compact('book'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Book $book)
    {
        $this->validate($request, [

            'title' => 'required|string|max:40|unique:books,title,' .$book,
            'url' => 'required|string|max:100|unique:books,url',
            'author' => 'required|string|max:100',
            'is_featured' => 'required|boolean',

        ]);



        $book->update(['title' => $request->title,
                       'url'   => $request->url,
                       'author' => $request->author,
                       'is_featured' => $request->is_featured]);


        return Redirect::route('book.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Book::destroy($id);

        return Redirect::route('book.index');

    }
}

