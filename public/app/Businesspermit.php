<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helper\Dataviewer;

class Businesspermit extends Model
{
	use Dataviewer;

    protected $table = 'businesspermit';
	   
    protected $fillable = [
         'businessname', 'businessaddress','user_id','status','owneraddress','dateofbirth','placeofbirth','purpose','purokleader_id','approval_status','created_at','updated_at'
    ];

     public static $tblcolumns = [
        'id', 'user_id','businessname', 'businessaddress','status','owneraddress','dateofbirth','placeofbirth','purpose','purokleader_id','created_at','updated_at'
    ];

    public static $columns = [ 'id', 'user id', 'business name', 'business address','status','owner address','date of birth','place of birth','purpose','purokleader id','Created at', 'Updated at'];

}
