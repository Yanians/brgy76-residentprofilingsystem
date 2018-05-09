<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClearanceRequest;
use App\Clearance;
use DB;
use HTML;
use Session;
use Auth;
use Storage;


class ClearanceController extends Controller
{
    
    public function save(ClearanceRequest $request)
    {
	      if ($request->photos) {
	      	 foreach ($request->photos as $photo) {
	      	 	$cl = new Clearance;
	      		$cl->photo = $photo->store('clearance_photo');
            $cl->user_id = $request->userid;  
            $cl->type = $request->type;  
            $cl->year = $request->year; 
            $cl->purokleader_id = $request->purokleader_id; 
	      		$cl->purpose = $request->purpose;	
	      		if ($cl->save()) {
	      	 		 Session::flash('msg_success', 'Clearance request submitted');

	      		}
	      	 }
	      }else{
	      	  Session::flash('msg_err', 'Please provide a photo');
	      } 
          	
          return redirect('resident/clearance/user/'.$request->userid);

    }

    public function getClearanceById($id)
    {
         $clearance = Clearance::query()->leftjoin('users','users.id', '=', 'clearance.user_id')
         ->where('clearance.id', '=', $id)->get();
         return $clearance;
    }

     public function getClearancestatusId($id)
    {    
        $c = Clearance::find($id);
        $c->seen = 1;
        $c->save();
         
         $clearance = Clearance::query()
         ->where('clearance.id', '=', $id)->get();
         return $clearance;
    }

    public function delete($id)
    {
    	   $clearance = Clearance::find($id);
   		  if ($clearance->delete()) {
           Storage::delete($clearance->photo);
   		  	
   		  	return 1;	
   		  }else{
   		  	return 0;
   		  }
    }


}
