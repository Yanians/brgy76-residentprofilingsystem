<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blotter;
use App\BlotterNotice;
use Auth;
use DB;
use  App\User;

class BlotterController extends Controller
{

	public function blotterFullname()
	{
		 $users = DB::table('users')
		 		 ->where('role', '=', 'Resident')
	            ->orderBy('id', 'desc')	
		 		->get();
		 $content = '';
		 $content.='<option value=""></option>';
		 foreach ($users as $u) {
		 	$content.='<option>'.$u->firstname.' '.$u->middlename.' '.$u->lastname.'</option>';
		 }
		 return $content;
	}

	public function getAllBlotterViewModal($id)
	{
		  $b = Blotter::find($id);
		  $content = '';

	     $users = DB::table('users')
        ->orderBy('id', 'desc')	
 		->get();

		$blotter_profilepic = '';
 		foreach ($users as $u) {
 		    $fullname = $u->firstname.' '.$u->middlename.' '.$u->lastname;

 		    if ($fullname == $b->blotter_fullname) {
 		    	$blotter_profilepic = $u->profilepic;
 		    }
 		}

		  if (!empty($b->id)) {
		  	 		 if (!empty(User::find($b->user_id)->profilepic))
		  	 		 {	
 					  $profilepic = '<img src="'.asset('storage/app/'.User::find($b->user_id)->profilepic).'"" class="img-circle img-bordered-sm" alt="User Image">';
                     } 
	                  else 
	                  {
	                     $profilepic ='<img src="'.asset("storage/app/photos/default.png").'" class="img-circle img-bordered-sm" alt="User Image">';
	                  }

	                   if (!empty($blotter_profilepic))
		  	 		 {	
 					  $blotter_pic = '<img src="'.asset('storage/app/'.$blotter_profilepic).'"" class="img-circle img-bordered-sm" alt="User Image">';
                     } 
	                  else 
	                  {
	                     $blotter_pic ='<img src="'.asset("storage/app/photos/default.png").'" class="img-circle img-bordered-sm" alt="User Image">';
	                  }
              
			 $content .= '<div class="user-block">';
		     $content .=  $profilepic;
		     $content .= '         <span class="username"> <a href="#">'.$b->blotter_fullname.'</a> </span>';
             $content .= '  <span class="description">Date added '.$b->created_at.'</span>  </div>';
             $content .= '  <p> Has a blotter report since '.$b->date.' '.$b->hour.' at '.$b->address_incedent.'</p>';
             $content .= '  <div class="box-body">';
             $content .= ' <div class="callout callout-danger">';
             $content .= ' <h4>Incedent Report</h4>';

             $content .= ' <p>'.$b->report.'</p></div>';
		          
             $content .= ' </div>';
             $content .= '  <div class="user-block pull-right">';
             $content .= $blotter_pic;
             $content .= '    <span class="username">';
             $content .= '    <a href="#">Blottered by: '.$b->person_fullname.'</a>';
             $content .= '  </span>';
             $content .= '  </div>';         
             $content .= '  <br class="clear-fix">';
             $content .= '  <br class="clear-fix">';
             $content .= '  <hr>';
		  		
		  }

		  return $content;
   		
	}


	public function getAllBlotter()
	{
	
		    $blotter = DB::table('blotter')
            ->orderBy('id', 'desc')	
	 		->get();

		 	if ($blotter) {
		 		$content = '<table class="table blotterTable"><thead><th>Complainant Full Name</th><th>Person Blotter Full Name</th><th>Witness Full Name</th> <th>Date and time </th>  <th> Actions</th></thead><tbody>';
		 		foreach ($blotter as $b) {
		 			$content .='<tr>';
		 			$content .='<td>'.$b->person_fullname.'</td>';
		 			$content .='<td>'.$b->blotter_fullname.'</td>';
		 			$content .='<td>'.$b->witness_fullname.'</td>';
		 			$content .='<td>'.$b->date.' '.$b->hour.'</td>';
		 			$content .='<td><a href="#" class="btn btn-info btn-sm" onclick="viewBlotter('.$b->id.')">View </a> <a href="#" class="btn btn-primary btn-sm" onclick="viewNoticeBlotter('.$b->id.')">View Notice </a></td>';
		 			$content .='</tr>';
		 		}
		 		$content.='</tbody></table>';
		 	}else{
		 		$content='No Data Found';
		 	}	

			 return $content;
	}
   	
	public function getBlotterByUserId($id)
	{
	
			 $blotter = DB::table('blotter')
		 		->where('user_id', '=', $id)
	            ->orderBy('id', 'desc')	
		 		->get();

		 	if ($blotter) {
		 		$content = '<table class="table blotterTable"><thead><th>Person Blotter Full Name</th><th>Witness Full Name</th> <th>Date and time </th><th> Actions</th></thead><tbody>';
		 		foreach ($blotter as $b) {
		 			$content .='<tr>';
		 			$content .='<td>'.$b->blotter_fullname.'</td>';
		 			$content .='<td>'.$b->witness_fullname.'</td>';
		 			$content .='<td>'.$b->date.' '.$b->hour.'</td>';

		 			$notice = DB::table('blotter_notice')
			 		->where('blotter_id', '=', $b->id)
			 		->where('is_viewed', '=', 0)
		            ->orderBy('id', 'desc')	
			 		->get();

			 		$totalnotice = count($notice);

		 			$content .='<td><a href="#" class="btn btn-info btn-sm" onclick="editBlotter('.$b->id.')">Edit </a> <a href="#" class="btn btn-primary btn-sm" onclick="viewNoticeBlotter('.$b->id.')">'.$totalnotice.' View Notice </a>  <a href="#" onclick="deleteBlotter('.$b->id.')" class="btn btn-danger btn-sm">Delete </a></td>';
		 			$content .='</tr>';
		 		}
		 		$content.='</tbody></table>';
		 	}else{
		 		$content='No Data Found';
		 	}	

			 return $content;
	}

	public function delete($id)
	{
		  $blotter_delete = Blotter::find($id);

   		  if ($blotter_delete->delete()) {
   		  	return 1;	
   		  }else{
   		  	return 0;
   		  }
	}

	public function edit($id)
	{
		 $blotter= Blotter::find($id)->toArray();
	     $users = DB::table('users')
		 		 ->where('role', '=', 'Resident')
	            ->orderBy('id', 'desc')	
		 		->get();

		      $content = '';	
			  foreach ($users as $u) {
			  	$fullname_user = $u->firstname.' '.$u->middlename.' '.$u->lastname;
			  	if ($fullname_user == $blotter['blotter_fullname']) {
			 	    $content.='<option selected>'.$u->firstname.' '.$u->middlename.' '.$u->lastname.'</option>';
			  	}else{
			 	    $content.='<option>'.$u->firstname.' '.$u->middlename.' '.$u->lastname.'</option>';
			  	}
			  }

			  $content2 = '';	
			  foreach ($users as $u) {
			  	$fullname_user = $u->firstname.' '.$u->middlename.' '.$u->lastname;
			  	if ($fullname_user == $blotter['witness_fullname']) {
			 	    $content2.='<option selected>'.$u->firstname.' '.$u->middlename.' '.$u->lastname.'</option>';
			  	}else{
			 	    $content2.='<option>'.$u->firstname.' '.$u->middlename.' '.$u->lastname.'</option>';
			  	}
			  }

			  $select = array('person_blotter'=>$content,'witness'=>$content2);  


			  $blotter_result = array_merge($blotter,$select);
		     return $blotter_result;
	}

	public function save(Request $request)
	{

		if ($request->person_fullname == '' ||  $request->contact == '' || $request->witness_contact == '' || $request->incedentreport == '' || $request->addressofincedent == '' || $request->date == '' || $request->hour == '') {
        	return 'Something went wrong please fillup all the fields';
        }else if(!is_numeric($request->witness_contact))
        {
        	return 'witness contact should be a number';
        }
        else if(!is_numeric($request->contact))
        {
        	return 'Your contact should be a number';
        }
        else{

        	
		        $blotter = new Blotter;
		        $blotter->user_id = $request->user_id;
		        $blotter->person_fullname = $request->person_fullname;
		        $blotter->person_contact = $request->contact;
		        $blotter->witness_contact = $request->witness_contact;
		        $blotter->report =   $request->incedentreport;
		        $blotter->address_incedent = $request->addressofincedent;
		        $blotter->date =  $request->date;
		        $blotter->hour = $request->hour;

		        if ($request->person_blotter == '') {
			        $blotter->blotter_fullname = $request->person_blotter_not_registered;
	        	}else if($request->person_blotter_not_registered == ''){
			        $blotter->blotter_fullname = $request->person_blotter;
	        	}

	        	 if ($request->person_witness == '') {
			        $blotter->witness_fullname = $request->person_blotter_not_registered;
	        	}else if($request->person_witness_not_registered == ''){
			        $blotter->witness_fullname = $request->person_witness;
	        	}

		        if ($blotter->save()) {
        			return 1;
		        }else{
        			return 0;
		        }
        }
	}

	public function save_edit(Request $request)
	{


		if ($request->person_fullname == '' || $request->person_blotter == '' || $request->person_witness == '' || $request->contact == '' || $request->witness_contact == '' || $request->incedentreport == '' || $request->addressofincedent == '' || $request->date == '' || $request->hour == '') {
        	return 'Something went wrong please fillup all the fields';
        }else if(!is_numeric($request->witness_contact))
        {
        	return 'witness contact should be a number';
        }
        else if(!is_numeric($request->contact))
        {
        	return 'Your contact should be a number';
        }
        else{
        	    $id = $request->edit_id;
				$blotter= Blotter::find($id);
		        $blotter->user_id = $request->user_id;
		        $blotter->person_fullname = $request->person_fullname;
		        $blotter->blotter_fullname = $request->person_blotter;
		        $blotter->witness_fullname = $request->person_witness;
		        $blotter->person_contact = $request->contact;
		        $blotter->witness_contact = $request->witness_contact;
		        $blotter->report =   $request->incedentreport;
		        $blotter->address_incedent = $request->addressofincedent;
		        $blotter->date =  $request->date;
		        $blotter->hour = $request->hour;
		        if ($blotter->save()) {
        			return 1;
		        }else{
        			return 0;
		        }
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
		 	$content .=	'<div class="alert alert-info">'.$n->notice.'</div>';		
 		} 		

							

		return $content;
	}

	public function blotternoticecount($id)
	{
		$notice = DB::table('blotter')
        ->leftJoin('blotter_notice', 'blotter.id', '=', 'blotter_notice.blotter_id')
 		->where('blotter.user_id', '=', $id)
 		->where('blotter_notice.is_viewed', '=', 0)
        ->orderBy('blotter.id', 'desc')	
 		->get();

 		return count($notice);
	}

	public function update_viewed($id)
	{
		$notice = DB::table('blotter_notice')
		 		->where('blotter_id', '=', $id)
				->update(['is_viewed' => 1]);

	}
}
