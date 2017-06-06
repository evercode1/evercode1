<?php

namespace App\Queries;

use App\Book;

class FeaturedBookQuery
{

    public static function sendFeaturedBook()
    {

        $data = Book::where('is_featured', 1)->first();

        return json_encode($data);

    }



}