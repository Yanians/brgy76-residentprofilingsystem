<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlotterNotice extends Model
{
    protected $table = 'blotter_notice';
	   
    protected $fillable = [
         'blotter_id', 'notice','is_viewed',
    ];
}
