<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use HTML;
use Session;
use Auth;



class ClerkController extends Controller
{
    public function request()
    {

       $data['businesspermit'] = DB::table('businesspermit')
         ->orderBy('id', 'desc') 
         ->get();

       $data['certification'] = DB::table('certification')
         ->orderBy('id', 'desc') 
         ->get();   

        $data['clearance'] = DB::table('clearance')
         ->orderBy('id', 'desc') 
         ->get();   
         
        $data['sp'] = DB::table('socialpension')
         ->orderBy('id', 'desc') 
         ->get();       

      return view('clerk.request',$data);
    }

     public function messages()
    {
      return view('clerk.messages');
        
    }

    public function getbspdatabyid($id,$fullname)
    {

        $data['q'] = DB::table('businesspermit')
         ->select(DB::raw('businesspermit.id,businesspermit.purokleader_id,businesspermit.businessname,businesspermit.businessaddress,
            businesspermit.status,businesspermit.owneraddress,businesspermit.dateofbirth,businesspermit.placeofbirth,businesspermit.purpose,users.firstname,users.middlename,users.lastname,users.profilepic,users.age'))
         ->leftJoin('users', 'users.id', '=', 'businesspermit.user_id')
         ->where('businesspermit.id', '=', $id)
         ->orderBy('businesspermit.id', 'desc') 
         ->get();
        $data['clerk'] = $fullname; 

        return $data; 
    }

    public function getbcdatabyid($id,$fullname)
    {

        $data['q'] = DB::table('certification')
         ->select(DB::raw('certification.id,certification.purokleader_id,certification.nameofchild,certification.dateofbirth,
            certification.placeofbirth,certification.nameofhospital,certification.nameofmother,certification.nameoffather,certification.address,users.firstname,users.middlename,users.lastname,users.profilepic,users.age'))
         ->leftJoin('users', 'users.id', '=', 'certification.user_id')
         ->where('certification.id', '=', $id)
         ->orderBy('certification.id', 'desc') 
         ->get();
        $data['clerk'] = $fullname; 

        return $data; 
    }
}
