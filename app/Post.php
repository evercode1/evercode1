<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
                           'slug',
                           'is_draft',
                           'published_at'
    ];

}
