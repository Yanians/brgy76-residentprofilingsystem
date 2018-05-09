<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Businesspermit;
use DB;
use HTML;
use Session;
use Auth;


class BusinesspermitController extends Controller
{
    
    public function save(Request $request)
    {
	      	$b = new Businesspermit;
            $b->user_id = $request->userid;  
            $b->status = $request->status;  
            $b->businessname = $request->businessname; 
            $b->businessaddress = $request->businessaddress; 
            $b->owneraddress = $request->owneraddress; 
            $b->dateofbirth = $request->dateofbirth; 
            $b->placeofbirth = $request->placeofbirth; 
            $b->purokleader_id = $request->purokleader_id['id']; 
	      	$b->purpose = $request->purpose;	

	      		if ($b->save()) {
	      	 	  return 1;
	      		}else{
                  return 0;  
                }
	    
    }

    public function edit($id)
    {


        $data = DB::table('businesspermit')
         ->select(DB::raw('businesspermit.id,businesspermit.purokleader_id,businesspermit.businessname,businesspermit.businessaddress,
            businesspermit.status,businesspermit.owneraddress,businesspermit.dateofbirth,businesspermit.placeofbirth,businesspermit.purpose,users.firstname,users.middlename,users.lastname'))
         ->leftJoin('users', 'users.id', '=', 'businesspermit.purokleader_id')
         ->where('businesspermit.id', '=', $id)
         ->orderBy('businesspermit.id', 'desc') 
         ->get();


         if ($data) {
            return $data;
         } 
    }


    public function edit_save(Request $request)
    {
        $id = $request->edit_id;
        $b= Businesspermit::find($id);
        $b->status = $request->status;  
        $b->businessname = $request->businessname; 
        $b->businessaddress = $request->businessaddress; 
        $b->owneraddress = $request->owneraddress; 
        $b->dateofbirth = $request->dateofbirth; 
        $b->placeofbirth = $request->placeofbirth; 
        if (!empty($request->purokleader_id['id'])) {
         $b->purokleader_id = $request->purokleader_id['id']; 
        }
        $b->purpose = $request->purpose;    

        if ($b->save()) {
            return 1;
        }else{
            return 0;
        }
    }


     public function delete($id)
    {
         $c = Businesspermit::find($id);
         if ($c->delete()) {
            return 1;   
          }else{
            return 0;
          }
    }


    public function getDatabyUserId($userid)
    {
         $users = DB::table('businesspermit')
         ->where('user_id', '=', $userid)
         ->orderBy('id', 'desc') 
         ->get();

         if ($users) {
            return $users;
         }
    }

    public function getData()
    {
        $model = Businesspermit::SearchPaginateAndOrder();  
        $columns = Businesspermit::$columns;  
        $tblcolumns = Businesspermit::$tblcolumns;  

        return response()
        ->json([
                 'model'=>$model,
                 'columns'=>$columns,
                 'tblcolumns'=>$tblcolumns
          ]);
    }
}
