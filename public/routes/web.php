<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sandbox', function () {
    return view('sandbox');
});

Route::get('/barangaylocation', function () {
	  
    return view('guest/barangaylocation');
});

Route::get('/barangayofficials', function () {
	   $data['users'] = DB::table('users')
	    ->where('role', '=', 'Barangay Captain')
	    ->orWhere('role', '=', 'Staff')
	    ->orWhere('role', '=', 'Purok leader')
	    ->orWhere('role', '=', 'Clerk')
	    ->orderBy('id', 'desc')
	    ->get();

    return view('guest/barangayofficials',$data);
});

Auth::routes();

 
Route::get('/auth/success', [
    'as'   => 'auth.success',
    'uses' => 'Auth\RegisterController@success'
]);

Route::group(['middleware' => 'auth'], function () {
		Route::prefix('/resident/')->group(function () {
				Route::get('/blotter', 'ResidentController@blotter')->name('blotter');
				Route::get('/businesspermit', 'ResidentController@businesspermit')->name('businesspermit');
				Route::get('/message', 'ResidentController@checkmessage')->name('checkmessage');
				Route::get('/clearance/user/{id}', 'ResidentController@clearance')->name('clearance');
				Route::get('/details', 'ResidentController@details')->name('details');
				Route::get('/location', 'ResidentController@location')->name('location');
				Route::get('/prerequisite', 'ResidentController@prerequisite')->name('prerequisite');
				Route::get('/certificate', 'ResidentController@requestcertificate')->name('requestcertificate');
				Route::get('/schedule', 'ResidentController@schedule')->name('schedule');
				Route::get('/socialpension', 'ResidentController@socialpension')->name('socialpension');
				Route::get('/profile', 'ResidentController@profile')->name('profile');
				Route::get('/settings', 'ResidentController@settings')->name('settings');
				Route::post('/editprofile', 'ResidentController@editprofile');
			    Route::post('clearance/save'   , 'ClearanceController@save')->name('clearance_save');
		 });
});

Route::prefix('/admin/')->group(function () {
		Route::get('/credentials', 'Admin\AdminController@credentials')->name('credentials');
	

		Route::get('/approval', 'Admin\AdminController@approval')->name('approval');

		Route::get('/clearance/approval/{id}/{status}', 'Admin\AdminController@clearanceapproval')->name('clearanceapproval');
		
		Route::get('/businesspermit/approval/{id}/{status}', 'Admin\AdminController@businesspermitapproval')->name('clearanceapproval');

		Route::get('/certification/approval/{id}/{status}', 'Admin\AdminController@certificationapproval')->name('clearanceapproval');

		Route::get('/socialpension/approval/{id}/{status}', 'Admin\AdminController@socialpensionapproval')->name('clearanceapproval');


		Route::get('/notifications', 'Admin\AdminController@notifications')->name('notifications');
		Route::get('/blotter', 'Admin\AdminController@blotter')->name('staff_blotter');
		Route::get('/announcement', 'Admin\AdminController@announcement')->name('announcement');
		Route::get('/receiveletter', 'Admin\AdminController@receiveletter')->name('receiveletter');
		Route::get('/setappointment', 'Admin\AdminController@setappointment')->name('setappointment');
		Route::get('/listusers', 'Admin\StaffController@listusers')->name('listusers');
		Route::get('/user/{username}', 'Admin\AdminController@profile')->name('profile');


		Route::get('/staff/purokleaderlocation', 'Admin\StaffController@purokLeaderLocation')->name('purokLeaderLocation');
		Route::get('/staff/blotter', 'Admin\StaffController@blotter')->name('staff_blotter');
		Route::get('/staff/request', 'Admin\StaffController@request')->name('staff_request');
		Route::get('/staff/registeredresidents', 'Admin\StaffController@registeredresidents')->name('registeredresidents');
		Route::get('/staff/privileges', 'Admin\StaffController@privileges')->name('privileges');
		Route::get('/staff/schedules', 'Admin\StaffController@schedules')->name('schedules');

		Route::get('/clerk/request', 'Admin\ClerkController@request')->name('clerkrequest');
		Route::get('/clerk/messages', 'Admin\ClerkController@messages')->name('messages');
		Route::get('/clerk/history', 'Admin\ClerkController@history')->name('history');
		
});


Route::prefix('/staff/')->group(function () {
		Route::get('/clearance/approval/{id}/{status}', 'Admin\StaffController@clearanceapproval')->name('clearanceapproval');
		
		Route::get('/businesspermit/approval/{id}/{status}', 'Admin\StaffController@businesspermitapproval')->name('clearanceapproval');

		Route::get('/certification/approval/{id}/{status}', 'Admin\StaffController@certificationapproval')->name('clearanceapproval');
		
		Route::get('/socialpension/approval/{id}/{status}', 'Admin\StaffController@socialpensionapproval')->name('clearanceapproval');

		Route::post('/schedule/save', 'Admin\StaffController@saveSchedule')->name('saveSchedule');
});	



Route::post('/upload', 'Admin\AdminController@uploadSubmit');
Route::post('/editprofile', 'Admin\AdminController@editprofile');


