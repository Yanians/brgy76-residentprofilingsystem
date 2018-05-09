<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helper\Dataviewer;

class Certification extends Model
{
	use Dataviewer;
    protected $table = 'certification';
    protected $fillable = [
        'id','user_id', 'purokleader_id' ,'nameofchild' , 'dateofbirth','placeofbirth','nameofhospital','nameofmother','nameoffather','address','created_at','updated_at','seen'
    ];

   public static $tblcolumns = [
        'id','user_id', 'purokleader_id' ,'nameofchild' , 'dateofbirth','placeofbirth','nameofhospital','nameofmother','nameoffather','address','created_at','updated_at'
    ];

    public static $columns = ['id','User Id', 'purokleader id' ,'Name of Child' , 'Date of Birth','Place of Birth','Name of Hospital','Name of Mother','Name of Father','Address','Created at','Updated at'];
}
