<?php

use Illuminate\Http\Request;
use App\Blotter;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Admin API

Route::prefix('/admin/')->group(function () {
		Route::get('users', function (Request $request) {
			 $users = DB::table('users')->get();
			 return $users;
		});

		Route::get('officials', function (Request $request) {
			 $users = DB::table('users')
			 		 ->where('role', '=', 'Purok leader')
		            ->orderBy('id', 'desc')	
			 		->get();
			 return $users;
		});
		
		Route::post('/blotter/sendnotice', 'Admin\StaffController@sendBlotterNotice')->name('sendBlotterNotice');
		Route::get('/blotter/notice/{id}', 'Admin\StaffController@notice')->name('noticeBlotterStaff');
		Route::get('/blotter/notice/delete/{id}', 'Admin\StaffController@delete_notice')->name('delete_notice');
		Route::get('/blotter/notice/edit/{id}', 'Admin\StaffController@edit_notice')->name('edit_notice');
		Route::post('/blotter/notice/save', 'Admin\StaffController@save_notice')->name('save_notice');
		Route::get('/purokleader/delete/{id}', 'Admin\StaffController@delete_purokleader')->name('delete_purokleader');
		Route::post('/purokleader/save', 'Admin\StaffController@save_purokleader')->name('save_purokleader');
		Route::get('/purokleaders', 'Admin\StaffController@purokleaders')->name('purokleaders');
		Route::get('staff/purokleader/edit/{id}', 'Admin\StaffController@edit_purokleader')->name('edit_purokleader');
		Route::post('staff/purokleader/edit_save', 'Admin\StaffController@edit_save_purokleader')->name('edit_save_purokleader');
		

		Route::get('request/businesspermit/{id}/{fullname}', 'Admin\ClerkController@getbspdatabyid');
		Route::get('request/certification/{id}/{fullname}', 'Admin\ClerkController@getbcdatabyid');

		Route::get('/schedule/{id}', 'Admin\StaffController@editSchedule');
		Route::post('/schedule/update', 'Admin\StaffController@updateSchedule');


});	


// Residents API
Route::prefix('/resident/')->group(function () {

	Route::get('profile/latlong/{lat}/{long}/{id}'   , 'ResidentController@update_userLatLong')->name('update_userLatLong');
	Route::get('profiles'   , 'ResidentController@profiles_pic')->name('profiles_pic');
	Route::get('getall/users'   , 'ResidentController@getallusers')->name('getallusers');
	Route::get('searched/users/{data}'   , 'ResidentController@getdata')->name('getdata');

	Route::get('fullname' , 'BlotterController@blotterFullname')->name('blotterFullname');
	Route::get('blotter'  , 'BlotterController@getAllBlotter')->name('getAllBlotter');
	Route::get('blotter/view/{id}'  , 'BlotterController@getAllBlotterViewModal')->name('getAllBlotterViewModal');
	Route::get('blotter/{id}'              , 'BlotterController@getBlotterByUserId')->name('getBlotterByUserId');
	Route::get('blotter/edit/{id}'         , 'BlotterController@edit')->name('getBlotterByUserId');
	Route::get('blotter/delete/{id}'       , 'BlotterController@delete')->name('blotter_delete');
	Route::post('blotter/save'             , 'BlotterController@save')->name('postBlottersave');
	Route::post('blotter/save_edit'   , 'BlotterController@save_edit')->name('postBlotterEdit');
	Route::get('blotter/notice/{id}'   , 'BlotterController@notice')->name('noticeBlotter');
	Route::get('blotternoticecount/{id}'   , 'BlotterController@blotternoticecount')->name('noticeBlotter');
	Route::get('blotter/notice/isviewed/{id}'   , 'BlotterController@update_viewed')->name('isviewed');



	Route::get('clearance/delete/{id}'       , 'ClearanceController@delete')->name('clearance_delete');
	Route::get('clearance/{id}'       , 'ClearanceController@getClearanceById')->name('getClearanceById');
	Route::get('clearance/status/{id}'       , 'ClearanceController@getClearancestatusId')->name('getClearanceById');


	Route::post('businesspermit/save'   , 'BusinesspermitController@save')->name('businesspermit_save');
	Route::get('businesspermit/user/{id}'       , 'BusinesspermitController@getDatabyUserId')->name('businesspermit_data');
	Route::get('businesspermit/delete/{id}'       , 'BusinesspermitController@delete')->name('businesspermit_delete');
	Route::get('businesspermit/edit/{id}'       , 'BusinesspermitController@edit')->name('businesspermit_edit');
	Route::post('businesspermit/edit/save'       , 'BusinesspermitController@edit_save')->name('businesspermit_edit_save');
	Route::get('businesspermit/viewdata'   , 'BusinesspermitController@getData')->name('businesspermit_getData');

	Route::post('socialpension/save'       , 'SocialpensionController@save')->name('socialpension_save');
	Route::get('socialpension/user/{id}'       , 'SocialpensionController@getdatabyUserId')->name('socialpension_getdata');
	Route::get('socialpension/edit/{id}'       , 'SocialpensionController@edit')->name('socialpension_edit');
	Route::get('socialpension/delete/{id}'       , 'SocialpensionController@delete')->name('socialpension_delete');
	Route::post('socialpension/edit/save'       , 'SocialpensionController@edit_save')->name('socialpension_edit_save');
    Route::get('socialpension/viewdata'   , 'SocialpensionController@getData')->name('socialpension_getData');
	

	Route::post('certification/save'       , 'CertificationController@save')->name('certification_save');
	Route::get('certification/user/{id}'       , 'CertificationController@getDatabyUserId')->name('certification_data');
	Route::get('certification/delete/{id}'       , 'CertificationController@delete')->name('certification_delete');
	Route::get('certification/edit/{id}'       , 'CertificationController@edit')->name('certification_edit');
	Route::post('certification/edit/save'       , 'CertificationController@edit_save')->name('certification_edit_save');
    Route::get('certification/viewdata'   , 'CertificationController@getData')->name('certification_getData');

    Route::get('schedule/viewdata'   , 'ScheduleController@getData')->name('schedule_getData');

    Route::post('message/send'   , 'MessageController@sendmessage')->name('sendmessage');
    
    Route::get('message/conversation/{sender_id}/{reciever_id}', 'MessageController@getconversation')->name('getconversation');

    Route::get('message/senders/{user_id}', 'MessageController@getMessageSender')->name('getMessageSender');





});	














