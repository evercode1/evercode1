<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogResource extends Model
{
    protected $fillable = ['title',
                           'url',
                           'is_featured'];

}
