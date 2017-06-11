<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactTopic;
use Illuminate\Support\Facades\Redirect;

class ContactTopicController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth', 'admin']);


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        return view('contact-topic.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        return view('contact-topic.create');

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

            'name' => 'required|unique:contact_topics|string|max:40',

        ]);

        $contactTopic = ContactTopic::create(['name' => $request->name]);

        $contactTopic->save();

        return Redirect::route('contact-topic.index');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $contactTopic = ContactTopic::findOrFail($id);

        return view('contact-topic.edit', compact('contactTopic'));

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
        $this->validate($request, [

            'name' => 'required|string|max:40|unique:contact_topics,name,' .$id

        ]);

        $contactTopic = ContactTopic::findOrFail($id);

        $contactTopic->update(['name' => $request->name]);


        return Redirect::route('contact-topic.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        ContactTopic::destroy($id);

        return Redirect::route('contact-topic.index');

    }
}
