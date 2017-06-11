<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClosedContactController extends Controller
{
    public function index()
    {

        return view('closed-contacts.index');

    }
}
