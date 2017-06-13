<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reply;

class Contact extends Model
{
    protected $fillable = ['contact_topic_id',
                           'user_id',
                           'message',
                           'status_id'];

    public function summary($message)
    {

        return substr($message, 0, 20) . '...';


    }

    public function markAsRead($id)
    {

        $reply = Reply::where('id', $id)->first();

        $reply->update(['is_read' => 1]);


    }

    public function contactTopic()
    {

        return $this->belongsTo('App\ContactTopic', 'contact_topic_id');


    }

    public function user()
    {

        return $this->belongsTo('App\User');


    }

    public function replies()
    {

        return $this->hasMany('App\Reply');

    }
}
