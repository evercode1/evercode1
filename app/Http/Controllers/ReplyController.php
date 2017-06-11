<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Reply;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'reply' => 'required|string|max:2000',
            'user_id' => 'required|integer',
            'contact_id' => 'required|integer',

        ]);

        $reply = Reply::create(['reply' => $request->reply,
                                'user_id' => $request->user_id,
                                'contact_id' => $request->contact_id,
                                'is_read' => 0

        ]);

        $reply->save();

        $reply->markContactClosed($reply->contact_id);

        return Redirect::route('contact.open');

    }
}
