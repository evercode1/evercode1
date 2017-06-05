<?php

namespace App;

use App\UtilityTraits\PostScopes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use PostScopes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
                         'created_at',
                         'updated_at',
                         'published_at'
    ];

    protected $fillable = [
                           'title',
                           'body',
                           'user_id',
                           'category_id',
                           'slug',
                           'is_published',
                           'published_at'
    ];

    public static function createPost(Request $request, $body, $slug)
    {

        $post = static::create(['title' => $request->title,
                                'category_id' => $request->category_id,
                                'is_published' => $request->is_published,
                                'body' => $body,
                                'slug' => $slug,
                                'user_id' => Auth::id(),
                                'published_at' => date('Y-m-d H:i:s')
        ]);

        $post->save();


    }

    public static function createDraft(Request $request, $body, $slug)
    {
        $post = static::create(['title' => $request->title,
                                'category_id' => $request->category_id,
                                'is_published' => $request->is_published,
                                'body' => $body,
                                'slug' => $slug,
                                'user_id' => Auth::id()
        ]);


        $post->save();

    }

    public static function updatePost(Request $request, $body, $slug, Post $post)
    {

        $post->update(['title' => $request->title,
                       'category_id' => $request->category_id,
                       'is_published' => $request->is_published,
                       'body' => $body,
                       'slug' => $slug,
                       'user_id' => Auth::id(),
                       'published_at' => date('Y-m-d H:i:s')
        ]);

    }

    public static function updateDraft(Request $request, $body, $slug, Post $post)
    {

        $post->update(['title' => $request->title,
                       'category_id' => $request->category_id,
                       'is_published' => $request->is_published,
                       'body' => $body,
                       'slug' => $slug,
                       'user_id' => Auth::id()
        ]);


    }



    public function getPublishedAtAttribute($value)
    {

       return Carbon::parse($value)->format('F d') . ', ' . Carbon::parse($value)->format('Y');

    }

    public function showMonth($date)
    {

        return Carbon::parse($date)->format('F') . ' - ' . Carbon::parse($date)->format('Y');

    }

    public function user()
    {


        return $this->belongsTo('App\User');

    }

    public function category()
    {

        return $this->belongsTo('App\Category');

    }



}
