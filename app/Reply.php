<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contact;

class Reply extends Model
{
    protected $fillable = ['reply',
                           'user_id',
                           'contact_id',
                           'is_read'];

    public function markContactClosed($id)
    {

        $contact = Contact::where('id', $id)->first();

        $contact->update(['status_id' => 0]);


    }

    public function contact()
    {

        return $this->belongsTo('App\Contact');

    }
}
