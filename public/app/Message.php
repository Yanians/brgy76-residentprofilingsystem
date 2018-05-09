<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    
    protected $table = 'messages';

    protected $fillable = [
        'id', 'user_id', 'reciever_id' ,'message'
    ];

}
