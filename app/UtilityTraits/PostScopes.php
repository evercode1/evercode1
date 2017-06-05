<?php

namespace App\UtilityTraits;

trait PostScopes
{

    public function scopeLive($query)
    {

        return $query->where('is_published', '=', 1)
            ->orderBy('published_at', 'desc');

    }

    public function scopeDraft($query)
    {

        return $query->where('is_published', '=', 0)
            ->orderBy('created_at', 'desc');

    }

    // use with first();

    Public function scopeNewest($query)
    {

        return $query->where('is_published', '=', 1)
            ->orderBy('created_at', 'desc')
            ->limit(1);

    }

    public function scopeByCategory($query, $id)
    {

        return $query->where(\DB::raw('category_id'), '=', $id);

    }

    public function scopeByDate($query, $year, $month)
    {
        return $query->where(\DB::raw('DATE_FORMAT(created_at, "%Y%m")'), '=', $year.$month);
    }




}


