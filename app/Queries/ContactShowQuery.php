<?php

namespace App\Queries;

use DB;
use App\Contact;

class ContactShowQuery
{

    public static function sendData($id, $userId)
    {

        $messages = DB::table('contacts')
                  ->select('contacts.id as id',
                           'contacts.message as message',
                           'replies.reply as reply',
                           'replies.is_read as read',
                            DB::raw('DATE_FORMAT(contacts.created_at,
                                    "%m-%d-%Y") as created'),
                             DB::raw('DATE_FORMAT(replies.created_at,
                                     "%m-%d-%Y") as replied'))
                  ->leftJoin('replies', 'contact_id', '=', 'contacts.id')
                  ->where('contacts.user_id', $id)
                  ->orderBy('contacts.created_at', 'desc')
                  ->get();

        $oldMessages = Contact::latest()->where('user_id', $userId)
                     ->where('status_id', 0)
                     ->get();

        return [$messages, $oldMessages];

    }



}