<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use App\Http\Requests\EditResidentProfileRequest;

use App\User;
use DB;
use HTML;
use Session;
use Auth;
use Storage;



class ResidentController extends Controller
{
    public function blotter()
    {
        return view('resident.blotter');
    }

    public function businesspermit()
    {
         
         $data['cl'] = DB::table('businesspermit')
         ->where('user_id', '=', Auth::user()->id)
         ->orderBy('id', 'desc')    
         ->get();

         $data['pl'] = DB::table('users')
         ->where('role', '=', 'Purok leader')
         ->orderBy('id', 'desc')    
         ->get();

        return view('resident.businesspermit',$data);
    	
    }

    public function checkmessage()
    {
        return view('resident.checkmessage');
    	
    }

    public function clearance($id)
    {

         $data['cl'] = DB::table('clearance')
         ->where('user_id', '=', $id)
         ->orderBy('id', 'desc')    
         ->get();

         $data['pl'] = DB::table('users')
         ->where('role', '=', 'Purok leader')
         ->orderBy('id', 'desc')    
         ->get(); 
         
         return view('resident.clearances',$data);
    	
    }

    public function getallusers()
    {
         $data = DB::table('users')
         ->orderBy('firstname', 'asc')    
         ->get();
         return  $data;
    }

    public function getdata($data)
    {
        $data = DB::table('users')
         ->where('firstname', 'like', $data.'%')
         ->orWhere('lastname','like', $data.'%')
         ->orWhere('middlename','like', $data.'%')
         ->orderBy('firstname', 'asc')    
         ->get();
         return  $data;
    }


    public function details()
    {
        return view('resident.details');
    	
    }


    public function location()
    {
        return view('resident.location');
    	
    }

    public function prerequisite()
    {
        return view('resident.prerequisite');
    	
    }


    public function requestcertificate()
    {
        return view('resident.requestcertificate');
    	
    }

    public function schedule()
    {
        return view('resident.schedule');
    	
    }

    public function socialpension()
    {
        return view('resident.socialpension');
    	
    }

    public function profile()
    {
        return view('resident.profile');
        
    }

    public function settings()
    {
        return view('resident.settings');
        
    }

    public function update_userLatLong($lat,$long,$id)
    {
        $user = User::find($id);
        $user->latitude = $lat;
        $user->longitude = $long;
        $user->save();  
    }

    public function profiles_pic()
    {
         $users = DB::table('users')
         ->where('role', '=', 'Resident')
        ->orderBy('id', 'desc') 
        ->get();
        return $users;

    }

     public function editprofile(EditResidentProfileRequest $request)
    {   


          if ($request->photos) {

                  foreach ($request->photos as $photo) {
                        
                        $user =  User::find($request->id);
                        $user->firstname  = $request->firstname;
                        $user->middlename = $request->middlename;
                        $user->lastname   = $request->lastname;
                        $user->email      = $request->email;

                        Storage::delete($user->profilepic);
                        
                        $user->profilepic = $photo->store('photos');
                        $user->username   = $request->username;

                        $usernameexist = DB::table('users')
                        ->where('id', '!=', Auth::user()->id)
                        ->Where('username',  $request->username)
                        ->get();

                        $emailexist = DB::table('users')
                        ->where('id', '!=', Auth::user()->id)
                        ->Where('email',  $request->email)
                        ->get();

                        if (count($usernameexist) > 0) {
                           Session::flash('error_msg', 'username already exist');
                           
                        }else if (count($emailexist) > 0) {
                          
                           Session::flash('error_msg', 'email already exist');

                        }else{
                            
                            if (!empty($request->password)) {
                               $user->password   = bcrypt($request->password);
                            }
                       
                            
                            if ($user->save()) {
                                   Session::flash('msg', 'Profile successfully updated');
                            } 
                        }


                      
                  }
          }else{
                        $user =  User::find($request->id);
                        $user->firstname  = $request->firstname;
                        $user->middlename = $request->middlename;
                        $user->lastname   = $request->lastname;
                        $user->email      = $request->email;
                        $user->username   = $request->username;
                      
                        $usernameexist = DB::table('users')
                        ->where('id', '!=', Auth::user()->id)
                        ->Where('username',  $request->username)
                        ->get();

                        $emailexist = DB::table('users')
                        ->where('id', '!=', Auth::user()->id)
                        ->Where('email',  $request->email)
                        ->get();

                        if (count($usernameexist) > 0) {
                           Session::flash('error_msg', 'Username alreade exist');
                           
                        }else if (count($emailexist) > 0) {
                          
                           Session::flash('error_msg', 'email already exist');

                        }else{
                            
                            if (!empty($request->password)) {
                               $user->password   = bcrypt($request->password);
                            }
                           

                            if ($user->save()) {
                                   Session::flash('msg', 'Profile successfully updated');
                            } 
                        }
            }

        return redirect('resident/settings');
        
    }

    
}
