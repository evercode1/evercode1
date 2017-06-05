<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedException;
use App\UtilityTraits\FormatsCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Post;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    use FormatsCode;

    public function __construct()
    {


        $this->middleware(['auth', 'admin'], ['except' => 'show']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('post.create', compact('categories'));
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
            'title' => 'required|string|unique:posts|max:100',
            'body' => 'required|string|max:4000',
            'category_id' => 'required|isValidCategory',
            'is_published' => 'required|boolean'

        ]);


        $body = $this->formatPostBody($request->body);

        $slug = str_slug($request->title, "-");

        $request->is_published ?

            Post::createPost($request, $body, $slug)

            :

            Post::createDraft($request, $body, $slug);


        return Redirect::route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $slug = '')
    {
        if ($post->slug !== $slug) {

            return Redirect::route('post.show', ['id' => $post->id,
                                                   'slug' => $post->slug], 301);
        }



        if (! $post->is_published){


            if (Auth::user()->isAdmin()){


                return view('post.show', compact('post'));

            }

            throw new UnauthorizedException();

        }

        return view('post.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $categoryId = $post->category_id;

        $categoryName = Category::getCategoryName($post->category_id);

        $categories = Category::all();

        return view('post.edit', compact('post',
                                         'postBody',
                                         'categories',
                                         'categoryId',
                                         'categoryName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|string|max:100|unique:posts,title,' .$post->id,
            'body' => 'required|string|max:4000',
            'category_id' => 'required|isValidCategory',
            'is_published' => 'required|boolean'

        ]);

        $body = $this->formatsEditedCode($request->body);

        $slug = str_slug($request->title, "-");

        $request->is_published ?

            Post::updatePost($request, $body, $slug, $post)

            :

            Post::updateDraft($request, $body, $slug, $post);

        return Redirect::route('post.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Post::destroy($id);


        return Redirect::route('post.index');

    }




}
