<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\BlotterNotice;
use DB;
use HTML;
use Session;
use Auth;

use App\Certification;
use App\Clearance;
use App\Socialpension;
use App\Businesspermit;
use App\Schedule;

class StaffController extends Controller
{


    public function listusers()
    {
		       	$data['listusers'] = DB::table('users')
            ->where('role', '=', 'Resident')
            ->orderBy('id', 'desc')
            ->get();
             return view('listusers',$data);

    }

    public function sendBlotterNotice(Request $request)
    {

           if (!empty($request->notice)) {
               $notice  = new  BlotterNotice;
               $notice->blotter_id = $request->blotter_id;
               $notice->notice = $request->notice;
               if ($notice->save()) {
                   return 1;
               }else{
                   return 0;
               }

            } else{
                return 'Notice form is empty';
            }
    }

    public function notice($id)
    {
      $notice = DB::table('blotter_notice')
           ->where('blotter_id', '=', $id)
                ->orderBy('id', 'desc') 
          ->get();

      $content = '';    
      foreach ($notice as $n) {
        $content .= '<div class="alert alert-info">'.$n->notice.' <a href="#" class="btn btn-danger btn-sm pull-right" onclick="deleteNotice('.$n->id.')" style="margin-left:5px;">Delete</a>  <a href="#" class="btn btn-primary btn-sm pull-right"  onclick="editNotice('.$n->id.')"> Edit</a> </div>';   
      }     

      return $content;
    }

    public function delete_notice($id)
    {
        $blotter_notice = BlotterNotice::find($id);
        if ($blotter_notice->delete()) {
          return 1;
        }else{
          return 0;
        }
    }

     public function delete_purokleader($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
          return 1;
        }else{
          return 0;
        }
    }

    public function edit_notice($id)
    {
        $blotter_notice = BlotterNotice::find($id);
        if (!empty($blotter_notice->notice)) {
              return $blotter_notice;
        }else{
          return 0;
        }
    } 


    public function editSchedule($id)
    {
        $s = Schedule::find($id);
        return $s;
    } 

    public function updateSchedule(Request $request)
    {
       if (!empty($request->datescheduled)) {
           $s = Schedule::find($request->schedule_id);
           $s->claim = $request->claim;
           $s->datescheduled = $request->datescheduled;
           $s->user_id = $request->user_id;
           if ($s->save()) {
               return 1;
           }else{
               return 0;
           }

        } else{
            return 'Schedule form is empty';
        }
    }

    public function save_notice(Request $request)
    {
        $blotter_notice = BlotterNotice::find($request->notice_id);
        if (!empty($request->notice)) {
           $blotter_notice->blotter_id = $request->blotter_id;
           $blotter_notice->notice = $request->notice;
           if ($blotter_notice->save()) {
               return 1;
           }else{
               return 0;
           }

        } else{
            return 'Notice form is empty';
        }
    }

    public function save_purokleader(Request $request)
    {
            if (!empty( $request->firstname) && !empty( $request->lastname) && !empty( $request->email) &&  !empty( $request->username)  &&  !empty( $request->password) ) {
                $user =  User::create([
                      'firstname' => $request->firstname,
                      'middlename' => $request->middlename,
                      'lastname' => $request->lastname,
                      'email' => $request->email,
                      'role' => $request->role,
                      'latitude' => $request->latitude,
                      'longitude' => $request->longitude,
                      'username' => $request->username,
                      'password' => bcrypt($request->password),
                  ]);
                  if (count($user) > 0) {
                     return 1;
                  } else{
                     return 0;
                  }
            }else{
              return 'Please fill up all the required field you missed something';
            }   
    }

    public function purokleaders()
    {
            $purokleaders = DB::table('users')
            ->where('role', '=', 'Purok leader')
            ->orderBy('id', 'desc')
            ->get();
           
            $content = '<table class="table purokleadersTable"><thead><th>Profile Pic</th><th>Full Name</th></thead><tbody>';
              foreach ($purokleaders as $p) {
                
                if (!empty($p->profilepic))
                {  
                    $profilepic = '<img src="'.asset('storage/app/'.$p->profilepic).'" class="img-circle img-bordered-sm" alt="User Image" style="width:50px;height:50px;">';
                } 
                else 
                {
                    $profilepic ='<img src="'.asset("storage/app/photos/default.png").'" class="img-circle img-bordered-sm" alt="User Image" style="width:50px;height:50px;">';
                }

                $content .='<tr>';
                $content .='<td>'.$profilepic.'</td>';
                $content .='<td>'.$p->firstname.' '.$p->lastname.'</td>';
                $content .='</tr>';
              }
              $content.='</tbody></table>';
              return $content;
    }

    public function purokLeaderLocation()
    {
        $data['pl'] = DB::table('users')
            ->where('role', '=', 'Purok leader')
            ->orderBy('id', 'desc')
            ->get();
         return view('staff.purokleaderlocation',$data);
             
    }


    public function blotter()
    {
      return view('staff.blotter');
    }


    public function request()
    {
         $data['clearance'] =  Clearance::all();
        $data['certification'] =  Certification::all();
        $data['socialpension'] =  Socialpension::all();
        $data['businesspermit'] =  Businesspermit::all();

      return view('staff.request',$data);

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

         $data['clearance'] =  Clearance::all();
        $data['certification'] =  Certification::all();
        $data['socialpension'] =  Socialpension::all();
        $data['businesspermit'] =  Businesspermit::all();

        return view('staff.request',$data);

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

        $data['clearance'] =  Clearance::all();
        $data['certification'] =  Certification::all();
        $data['socialpension'] =  Socialpension::all();
        $data['businesspermit'] =  Businesspermit::all();

        return view('staff.request',$data);
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

        $data['clearance'] =  Clearance::all();
        $data['certification'] =  Certification::all();
        $data['socialpension'] =  Socialpension::all();
        $data['businesspermit'] =  Businesspermit::all();

        return view('staff.request',$data);
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

        $data['clearance'] =  Clearance::all();
        $data['certification'] =  Certification::all();
        $data['socialpension'] =  Socialpension::all();
        $data['businesspermit'] =  Businesspermit::all();

        return view('staff.request',$data);
    }


    public function registeredresidents()
    {
      $data['user'] = User::where('role','Resident')->get();

      return view('staff.registeredresidents',$data);

    }

    public function privileges()
    {

      return view('staff.privileges');

    }

    public function schedules()
    {
      $data['pl'] = User::all();
        $data['s'] = Schedule::all();

      return view('staff.schedules',$data);

    }

    public function saveSchedule(Request $request)
    {
        $s = new Schedule;
        $s->claim = $request->claim;
        $s->datescheduled = $request->datescheduled;
        $s->user_id = $request->user_id;
        $s->save();
        $data['pl'] = User::all();
        $data['s'] = Schedule::all();
        return view('staff.schedules',$data);
    }

    

    public function edit_purokleader($id)
    {
        $pl = User::find($id);
        if (!empty($pl)) {
           return $pl;
        }

    }

    public function edit_save_purokleader(Request $request)
    {
        $pl =  User::find($request->edit_purok_id);
        $pl->firstname = $request->firstname;
        $pl->middlename = $request->middlename;
        $pl->lastname = $request->lastname;
        $pl->email = $request->email;
        $pl->presentaddress = $request->address;
        if (!empty($request->password)) {
            $pl->password = $request->password;
        }

        if ($pl->save()) {
            return 1;
        }else{
          return 0;
        }
    } 
    


}
