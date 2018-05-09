<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Socialpension;

use DB;
use HTML;
use Session;

class SocialpensionController extends Controller
{
    
    public function save(Request $request)
    {
    	$sp = new Socialpension;
    	$sp->purpose = $request->purpose;
    	$sp->yearresident = $request->yearresident;
    	$sp->status = $request->status;
    	$sp->dateofbirth = $request->dateofbirth;
    	$sp->address = $request->address;
    	$sp->user_id = $request->userid;
    	$sp->purokleader_id = $request->purokleader_id['id'];

    	if ($sp->save()) {
    		return 1;
    	}else{
			return 0;    	   
    	}
    }

    public function edit_save(Request $request)
    {
        $id = $request->edit_id;
        $sp= Socialpension::find($id);
        $sp->purpose = $request->purpose;
        $sp->yearresident = $request->yearresident;
        $sp->status = $request->status;
        $sp->dateofbirth = $request->dateofbirth;
        $sp->address = $request->address;
        $sp->user_id = $request->userid;
        $sp->purokleader_id = $request->purokleader_id['id'];

        if ($sp->save()) {
            return 1;
        }else{
            return 0;
        }
    }


    public function getdatabyUserId($userid)
    {
         $users = DB::table('socialpension')
         ->where('user_id', '=', $userid)
         ->orderBy('id', 'desc') 
         ->get();

         if ($users) {
            return $users;
         }
    }

    public function edit($id)
    {
      

         $data = DB::table('socialpension')
         ->select(DB::raw('socialpension.id,socialpension.purokleader_id,socialpension.status,socialpension.dateofbirth,
            socialpension.address,socialpension.purpose,socialpension.yearresident,users.firstname,users.middlename,users.lastname'))
         ->leftJoin('users', 'users.id', '=', 'socialpension.purokleader_id')
         ->where('socialpension.id', '=', $id)
         ->orderBy('socialpension.id', 'desc') 
         ->get();

         if ($data) {
            return $data;
         } 
    }

    public function getData()
    {
        $model = Socialpension::SearchPaginateAndOrder();  
        $columns = Socialpension::$columns;  
        $tblcolumns = Socialpension::$tblcolumns;  

        return response()
        ->json([
                 'model'=>$model,
                 'columns'=>$columns,
                 'tblcolumns'=>$tblcolumns
          ]);
    }


    public function delete($id)
    {
         $s = Socialpension::find($id);
         if ($s->delete()) {
            return 1;   
          }else{
            return 0;
          }
        
    }
}
