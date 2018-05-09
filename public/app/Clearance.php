<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
     protected $table = 'clearance';
	   
   protected $fillable = [
         'user_id', 'photo' ,'type' , 'year','purpose','purokleader_id','status','seen'
    ];
}
