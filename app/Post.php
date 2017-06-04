<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{

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

    public function getPublishedAtAttribute($value)
    {

       return Carbon::parse($value)->format('F d') . ', ' . Carbon::parse($value)->format('Y');

    }

    public function user()
    {


        return $this->belongsTo('App\User');

    }

    public function category()
    {

        return $this->hasOne('App\Category');

    }

}
