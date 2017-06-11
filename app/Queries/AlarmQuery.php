<?php

namespace App\Queries;

use Illuminate\Support\Facades\Auth;
use DB;

class AlarmQuery
{

    public static function sendData()
    {

        $id = Auth::id();


        $data = DB::table('contacts')
            ->select('contacts.id as id',
                'contacts.message as message',
                'replies.reply as reply',
                'replies.is_read as read')
                 ->leftJoin('replies', 'contact_id', '=', 'contacts.id')
                 ->where('contacts.user_id', $id)
                 ->where('replies.is_read', 0)
                 ->orderBy('contacts.created_at', 'desc')
                 ->get();


        return json_encode(count($data));

    }



}