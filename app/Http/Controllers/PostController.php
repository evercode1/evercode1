<?php

namespace App\Http\Controllers;

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


        $this->middleware(['auth', 'admin']);

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

        if ($request->is_published) {

            $post = Post::create(['title' => $request->title,
                                  'category_id' => $request->category_id,
                                  'is_published' => $request->is_published,
                                  'body' => $body,
                                  'slug' => $slug,
                                  'user_id' => Auth::id(),
                                  'published_at' => date('Y-m-d H:i:s')
            ]);


        } else {

            $post = Post::create(['title' => $request->title,
                                  'category_id' => $request->category_id,
                                  'is_published' => $request->is_published,
                                  'body' => $body,
                                  'slug' => $slug,
                                  'user_id' => Auth::id()
            ]);


        }



        $post->save();


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

        $categories = Category::all();

        return view('post.show', compact('post', 'categories'));

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

        $categoryName = Category::where('id', $categoryId)->first();

        $categoryName = ($categoryName['name']);

        $categories = Category::all();

        return view('post.edit', compact('post', 'postBody', 'categories', 'categoryId', 'categoryName'));
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

        if ($request->is_published) {

            $post->update(['title' => $request->title,
                                  'category_id' => $request->category_id,
                                  'is_published' => $request->is_published,
                                  'body' => $body,
                                  'slug' => $slug,
                                  'user_id' => Auth::id(),
                                  'published_at' => date('Y-m-d H:i:s')
            ]);


        } else {

            $post->update(['title' => $request->title,
                                  'category_id' => $request->category_id,
                                  'is_published' => $request->is_published,
                                  'body' => $body,
                                  'slug' => $slug,
                                  'user_id' => Auth::id()
            ]);


        }


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
