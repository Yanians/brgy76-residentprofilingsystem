<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blotter extends Model
{		

	   protected $table = 'blotter';
	   
       protected $fillable = [
	         'person_fullname', 'blotter_fullname', 'witness_fullname','person_contact','witness_contact','report','address_incedent','date','hour','user_id'
	    ];
}
