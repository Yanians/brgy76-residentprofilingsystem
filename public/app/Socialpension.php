<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helper\Dataviewer;

class Socialpension extends Model
{
	
	use Dataviewer;
    protected $table = 'socialpension';
	   
    protected $fillable = [
        'id', 'user_id', 'purokleader_id' ,'status' , 'yearresident','purpose','address','dateofbirth','approval_status','seen'
    ];

    public static $tblcolumns = [ 'id', 'user_id', 'purokleader_id' ,'status' , 'yearresident','purpose','address','dateofbirth','created_at','updated_at'
    ];

    public static $columns = ['id', 'user id', 'purokleader id' ,'status' , 'year of residence','purpose','address','date of birth','created at','updated at'];
}
