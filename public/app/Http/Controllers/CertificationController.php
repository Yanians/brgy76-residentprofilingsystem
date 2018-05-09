<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certification;

use DB;
use HTML;
use Session;


class CertificationController extends Controller
{
   public function save(Request $request)
    {
    	$c = new Certification;
    	$c->nameofchild = $request->nameofchild;
    	$c->nameofhospital = $request->hospitalname;
    	$c->placeofbirth = $request->placeofbirth;
    	$c->dateofbirth = $request->dateofbirth;
    	$c->nameoffather = $request->father;
    	$c->nameofmother = $request->mother;
    	$c->address = $request->address;
    	$c->user_id = $request->userid;
    	$c->purokleader_id = $request->purokleader_id['id'];               

    	if ($c->save()) {
    		return 1;
    	}else{
			return 0;    	   
    	}
    }

     public function edit($id)
    {
         $data = DB::table('certification')
         ->select(DB::raw('certification.id,certification.purokleader_id,certification.nameofchild,certification.dateofbirth,
            certification.dateofbirth,certification.placeofbirth,certification.nameoffather,certification.nameofmother,certification.address,users.firstname,certification.nameofhospital,users.middlename,users.lastname'))
         ->leftJoin('users', 'users.id', '=', 'certification.purokleader_id')
         ->where('certification.id', '=', $id)
         ->orderBy('certification.id', 'desc') 
         ->get();

         if ($data) {
            return $data;
         } 
    }


    public function delete($id)
    {
         $c = Certification::find($id);
         if ($c->delete()) {
            return 1;   
          }else{
            return 0;
          }
        
    }

      public function edit_save(Request $request)
    {
        $id = $request->edit_id;
        $c= Certification::find($id);
        $c->dateofbirth = $request->dateofbirth;
        $c->address = $request->address;
        if (!empty($request->purokleader_id['id'])) {
         $c->purokleader_id = $request->purokleader_id['id'];
        }
        $c->nameofchild = $request->nameofchild;
        $c->placeofbirth = $request->placeofbirth;
        $c->nameofhospital = $request->nameofhospital;
        $c->nameofmother = $request->nameofmother;
        $c->nameoffather = $request->nameoffather;

        if ($c->save()) {
            return 1;
        }else{
            return 0;
        }
    }

    public function getDatabyUserId($userid)
    {
    	 $users = DB::table('certification')
         ->where('user_id', '=', $userid)
         ->orderBy('id', 'desc') 
         ->get();

         if ($users) {
            return $users;
         }
    }

    public function getData()
    {
        $model = Certification::SearchPaginateAndOrder();  
        $columns = Certification::$columns;  
        $tblcolumns = Certification::$tblcolumns;  

        return response()
        ->json([
                 'model'=>$model,
                 'columns'=>$columns,
                 'tblcolumns'=>$tblcolumns
          ]);
    }
}
  