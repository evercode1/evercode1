<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedException;
use Illuminate\Http\Request;
use App\Contact;
use App\ContactTopic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Queries\ContactShowQuery;

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
            'message' => 'required|string|max:4000|min:10',



        ]);

        $contact = Contact::create(['contact_topic_id' => $request->contact_topic_id,
                                    'message' => $request->message,
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


                list($oldMessages, $messages) = ContactShowQuery::sendData($id, $contact->user_id);


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
