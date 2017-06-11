<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedException;
use Illuminate\Http\Request;
use App\Contact;
use App\ContactTopic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['except' => ['create', 'store']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if ( ! Auth::user()->isAdmin()){

            throw new UnauthorizedException();

        }

        return view('contact.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        $topics = ContactTopic::all();

        return view('contact.create', compact('topics'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {



        $this->validate($request, [

            'contact_topic_id' => 'required|isValidTopic',
            'message' => 'required|string|max:1000|min:10',



        ]);

        $contact = Contact::create(['contact_topic_id' => $request->contact_topic_id,
                                    'message' => $request->message,
                                    'is_read' => 0,
                                     'user_id' => Auth::id()]);

        $contact->save();

        if (Auth::user()->isAdmin()){

            return Redirect::route('contact.open');

        }

        return view('contact.confirmation');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Contact $contact)
    {

            $id = Auth::id();

            if ( Auth::user()->isAdmin() ){

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



                $oldMessages = Contact::latest()->where('user_id', $contact->user_id)
                                            ->where('status_id', 0)
                                            ->get();




                return view('contact.show', compact('contact', 'oldMessages', 'messages'));

            }

            throw new UnauthorizedException();


    }

    public function edit($contact)
    {
        // we don't allow editing of contacts

        throw new UnauthorizedException();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        // we don't allow updating of contacts

        throw new UnauthorizedException();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        if ( ! Auth::user()->isAdmin()){

            throw new UnauthorizedException();

        }

        Contact::destroy($id);

        return Redirect::route('contact.index');

    }
}
