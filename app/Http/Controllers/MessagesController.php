<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contact;
use App\Reply;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');


    }
    public function index()
    {

        $id = Auth::id();


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


        return view('messages.index', compact('messages'));


    }

    public function show($id)
    {

        $message = Contact::findOrFail($id);

        if ($message->user_id != Auth::id()){

            throw new UnauthorizedException();
        }

        $reply = false;

          if ($reply = Reply::where('contact_id', $message->id)->first()){

              $message->markAsRead($reply->id);

          }



        return view('messages.show', compact('message', 'reply'));

    }
}
