<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
use App\Http\Requests\EditProfileRequest;
use App\User;
use DB;
use HTML;
use Session;
use Auth;
use Storage;

use App\Certification;
use App\Clearance;
use App\Socialpension;
use App\Businesspermit;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile($username)
    { 
        return view('profile');
    }


   public function credentials()
    {

      if (Auth::user()->role == 'Barangay Captain') {
                        $data['users'] = DB::table('users')
                        ->where('role', '=', 'Barangay Captain')
                        ->orWhere('role', '=', 'Admin')
                        ->orderBy('id', 'desc')
                        ->limit(8)
                        ->get();

      }elseif (Auth::user()->role == 'Admin') {
                        $data['users'] = DB::table('users')
                        ->where('role', '=', 'Staff')
                        ->orWhere('role', '=', 'Clerk')
                        ->orderBy('id', 'desc')
                        ->limit(8)
                        ->get();
      }

      elseif (Auth::user()->role == 'Clerk') {
                         $data['users'] = DB::table('users')
                        ->where('role', '=', 'Purok leader')
                        ->orderBy('id', 'desc')
                        ->limit(8)
                        ->get();
      }

      elseif (Auth::user()->role == 'Staff') {
                        $data['users'] = DB::table('users')
                        ->where('role', '=', 'Purok leader')
                        ->orderBy('id', 'desc')
                        ->limit(8)
                        ->get();
      }

      elseif (Auth::user()->role == 'Purok leader') {
          $purokleader_id = Auth::user()->id;

          $data['users'] = DB::table('users')
           ->select(DB::raw('users.firstname,users.middlename,users.lastname,users.profilepic,users.created_at'))

          ->leftJoin('clearance', 'users.id',      '=', 'clearance.user_id')
          ->leftJoin('socialpension', 'users.id',  '=', 'socialpension.user_id')
          ->leftJoin('businesspermit', 'users.id', '=', 'businesspermit.user_id')
          ->leftJoin('certification', 'users.id',  '=', 'certification.user_id')

          ->orWhere('socialpension.purokleader_id', '=', $purokleader_id )
          ->orWhere('clearance.purokleader_id', '=', $purokleader_id )
          ->orWhere('businesspermit.purokleader_id', '=', $purokleader_id )
          ->orWhere('certification.purokleader_id', '=', $purokleader_id )
          ->get();


          // var_dump($data);
          // die();
      }
        $data['clearance_count'] =  Clearance::where('status', '=', '')->whereNull('status')->get()->count();

        $data['socialpension_count'] =  Socialpension::where('approval_status', '=', '')->whereNull('approval_status')->get()->count();

        $data['certification_count'] =  Certification::where('status', '=', '')->whereNull('status')->get()->count();

        $data['businesspermit_count'] =  Businesspermit::where('approval_status', '=', '')->whereNull('approval_status')->get()->count();


        $data['notif_count'] =  $data['businesspermit_count'] + $data['socialpension_count'] + $data['certification_count']  + $data['clearance_count'];
        
        return view('credentials',$data);
    }



    public function announcement()
    {
        return view('announcement');
    }

     public function receiveletter()
    {
        return view('receiveletter');
    }


     public function setappointment()
    {
        return view('setappointment');
    }

    public function approval()
    {   

             $data['clearance'] =  Clearance::where('status', '!=', '')->orWhereNotNull('status')->get();
        $data['certification'] =  Certification::where('status', '!=', '')->orWhereNotNull('status')->get();
        $data['socialpension'] =  Socialpension::where('approval_status', '!=', '')->orWhereNotNull('approval_status')->get();
        $data['businesspermit'] =  Businesspermit::where('approval_status', '!=', '')->orWhereNotNull('approval_status')->get();


        $data['clearance_count'] =  Clearance::where('status', '=', '')->whereNull('status')->get()->count();

        $data['socialpension_count'] =  Socialpension::where('approval_status', '=', '')->whereNull('approval_status')->get()->count();

        $data['certification_count'] =  Certification::where('status', '=', '')->whereNull('status')->get()->count();

        $data['businesspermit_count'] =  Businesspermit::where('approval_status', '=', '')->whereNull('approval_status')->get()->count();


        $data['notif_count'] =  $data['businesspermit_count'] + $data['socialpension_count'] + $data['certification_count']  + $data['clearance_count'];

        return view('approval',$data);
    }

    public function clearanceapproval($id,$status)
    {
       

        if ($status == 'approved') {
            $c = Clearance::find($id);
            $c->status = 'approved';
            $c->save();
             Session::flash('msg', 'Clearance approved');
        }else{
            $c = Clearance::find($id);
            $c->status = 'reject';
            $c->save();
             Session::flash('msg', 'Clearance rejected');
        }

       $data['clearance'] =  Clearance::where('status', '!=', '')->orWhereNotNull('status')->get();
        $data['certification'] =  Certification::where('status', '!=', '')->orWhereNotNull('status')->get();
        $data['socialpension'] =  Socialpension::where('approval_status', '!=', '')->orWhereNotNull('approval_status')->get();
        $data['businesspermit'] =  Businesspermit::where('approval_status', '!=', '')->orWhereNotNull('approval_status')->get();


        $data['clearance_count'] =  Clearance::where('status', '=', '')->whereNull('status')->get()->count();

        $data['socialpension_count'] =  Socialpension::where('approval_status', '=', '')->whereNull('approval_status')->get()->count();

        $data['certification_count'] =  Certification::where('status', '=', '')->whereNull('status')->get()->count();

        $data['businesspermit_count'] =  Businesspermit::where('approval_status', '=', '')->whereNull('approval_status')->get()->count();


        $data['notif_count'] =  $data['businesspermit_count'] + $data['socialpension_count'] + $data['certification_count']  + $data['clearance_count'];

        return view('approval',$data);

    }

    public function businesspermitapproval($id,$status)
    {
         if ($status == 'approved') {
            $c = Businesspermit::find($id);
            $c->approval_status = 'approved';
            $c->save();
             Session::flash('msg', 'Business permit approved');
        }else{
            $c = Businesspermit::find($id);
            $c->approval_status = 'reject';
            $c->save();
             Session::flash('msg', 'Business permit rejected');
        }

        $data['clearance'] =  Clearance::where('status', '!=', '')->orWhereNotNull('status')->get();
        $data['certification'] =  Certification::where('status', '!=', '')->orWhereNotNull('status')->get();
        $data['socialpension'] =  Socialpension::where('approval_status', '!=', '')->orWhereNotNull('approval_status')->get();
        $data['businesspermit'] =  Businesspermit::where('approval_status', '!=', '')->orWhereNotNull('approval_status')->get();


        $data['clearance_count'] =  Clearance::where('status', '=', '')->whereNull('status')->get()->count();

        $data['socialpension_count'] =  Socialpension::where('approval_status', '=', '')->whereNull('approval_status')->get()->count();

        $data['certification_count'] =  Certification::where('status', '=', '')->whereNull('status')->get()->count();

        $data['businesspermit_count'] =  Businesspermit::where('approval_status', '=', '')->whereNull('approval_status')->get()->count();


        $data['notif_count'] =  $data['businesspermit_count'] + $data['socialpension_count'] + $data['certification_count']  + $data['clearance_count'];

        return view('approval',$data);
    }

    public function certificationapproval($id,$status)
    {
         if ($status == 'approved') {
            $c = Certification::find($id);
            $c->status = 'approved';
            $c->save();
             Session::flash('msg', 'Certification  approved');
        }else{
            $c = Certification::find($id);
            $c->status = 'reject';
            $c->save();
             Session::flash('msg', 'Certification  rejected');
        }

         $data['clearance'] =  Clearance::where('status', '!=', '')->orWhereNotNull('status')->get();
        $data['certification'] =  Certification::where('status', '!=', '')->orWhereNotNull('status')->get();
        $data['socialpension'] =  Socialpension::where('approval_status', '!=', '')->orWhereNotNull('approval_status')->get();
        $data['businesspermit'] =  Businesspermit::where('approval_status', '!=', '')->orWhereNotNull('approval_status')->get();


        $data['clearance_count'] =  Clearance::where('status', '=', '')->whereNull('status')->get()->count();

        $data['socialpension_count'] =  Socialpension::where('approval_status', '=', '')->whereNull('approval_status')->get()->count();

        $data['certification_count'] =  Certification::where('status', '=', '')->whereNull('status')->get()->count();

        $data['businesspermit_count'] =  Businesspermit::where('approval_status', '=', '')->whereNull('approval_status')->get()->count();


        $data['notif_count'] =  $data['businesspermit_count'] + $data['socialpension_count'] + $data['certification_count']  + $data['clearance_count'];

        return view('approval',$data);
    }

    public function socialpensionapproval($id,$status)
    {
         if ($status == 'approved') {
            $c = Socialpension::find($id);
            $c->approval_status = 'approved';
            $c->save();
             Session::flash('msg', 'Socialpension  approved');
        }else{
            $c = Socialpension::find($id);
            $c->approval_status = 'reject';
            $c->save();
             Session::flash('msg', 'Socialpension  rejected');
        }

        $data['clearance'] =  Clearance::where('status', '!=', '')->orWhereNotNull('status')->get();
        $data['certification'] =  Certification::where('status', '!=', '')->orWhereNotNull('status')->get();
        $data['socialpension'] =  Socialpension::where('approval_status', '!=', '')->orWhereNotNull('approval_status')->get();
        $data['businesspermit'] =  Businesspermit::where('approval_status', '!=', '')->orWhereNotNull('approval_status')->get();

         $data['clearance_count'] =  Clearance::where('status', '=', '')->whereNull('status')->get()->count();

        $data['socialpension_count'] =  Socialpension::where('approval_status', '=', '')->whereNull('approval_status')->get()->count();

        $data['certification_count'] =  Certification::where('status', '=', '')->whereNull('status')->get()->count();

        $data['businesspermit_count'] =  Businesspermit::where('approval_status', '=', '')->whereNull('approval_status')->get()->count();


        $data['notif_count'] =  $data['businesspermit_count'] + $data['socialpension_count'] + $data['certification_count']  + $data['clearance_count'];

        return view('approval',$data);
    }

    

    public function notifications()
    {
        $purokleader_id = Auth::user()->id;

        $data['clearance']     =  Clearance::where('purokleader_id', '=', $purokleader_id)->whereNull('status')->get();


        $data['certification'] =  Certification::where('purokleader_id', '=', $purokleader_id)->whereNull('status')->get();

        $data['socialpension'] =  Socialpension::where('approval_status', '=', '')->where('purokleader_id', '=', $purokleader_id)->whereNull('approval_status')->get();

        $data['businesspermit'] =  Businesspermit::where('purokleader_id', '=', $purokleader_id)->whereNull('approval_status')->get();

        $data['clearance_count'] =  Clearance::where('purokleader_id', '=', $purokleader_id)->whereNull('status')->get()->count();

        $data['socialpension_count'] =  Socialpension::where('purokleader_id', '=', $purokleader_id)->whereNull('approval_status')->get()->count();

        $data['certification_count'] =  Certification::where('purokleader_id', '=', $purokleader_id)->whereNull('status')->get()->count();

        $data['businesspermit_count'] =  Businesspermit::where('purokleader_id', '=', $purokleader_id)->whereNull('approval_status')->get()->count();


        $data['notif_count'] =  $data['businesspermit_count'] + $data['socialpension_count'] + $data['certification_count']  + $data['clearance_count'];

        return view('notifications',$data);
    }

    public function uploadSubmit(UploadRequest $request)
    {   


          if ($request->photos) {
                  foreach ($request->photos as $photo) {
                        $user =  User::create([
                              'firstname' => $request->firstname,
                              'middlename' => $request->middlename,
                              'lastname' => $request->lastname,
                              'email' => $request->email,
                              'role' => $request->role,
                              'presentaddress' => $request->address,
                              'profilepic' => $photo->store('photos'),
                              'username' => $request->username,
                              'password' => bcrypt($request->password),
                          ]);
                       if ($user) {
                           Session::flash('msg', 'Credential successfully added to the database');
                        } 
                  }
          }else{
                $user =  User::create([
                      'firstname' => $request->firstname,
                      'middlename' => $request->middlename,
                      'lastname' => $request->lastname,
                      'email' => $request->email,
                      'role' => $request->role,
                      'presentaddress' => $request->address,
                      'username' => $request->username,
                      'password' => bcrypt($request->password),
                  ]);
               if ($user) {
                   Session::flash('msg', 'Credential successfully added to the database');
                } 
          }
      }

    public function editprofile(EditProfileRequest $request)
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

                    if (!empty($request->password)) {
                           $user->password   = bcrypt($request->password);
                    }
               

                   if ($user->save()) {
                       Session::flash('msg', 'Profile successfully updated');
                    } 
              }
      }else{
                    $user =  User::find($request->id);
                    $user->firstname  = $request->firstname;
                    $user->middlename = $request->middlename;
                    $user->lastname   = $request->lastname;
                    $user->email      = $request->email;
                    $user->username   = $request->username;
                    if (!empty($request->password)) {
                           $user->password   = bcrypt($request->password);
                    }

           if ($user->save()) {
               Session::flash('msg', 'Profile successfully updated');
            } 
      }
        

        return redirect('admin/user/'.$request->username);
        
    }
}
