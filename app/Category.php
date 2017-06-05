<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['name'];

    /**
     * @param $categoryId
     * @return mixed
     */
    public static function getCategoryName($categoryId)
    {
        $categoryName = static::where('id', $categoryId)->first();

        $categoryName = ($categoryName['name']);

        return $categoryName;
    }

    public function posts()
    {

        return $this->hasMany('App\Post');

    }

}
