<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpenContactController extends Controller
{
    public function index()
    {

        return view('open-contacts.index');

    }
}
