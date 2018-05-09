<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use DB;

class MessageController extends Controller
{
    public function sendmessage(Request $request)
    {
    	$m = new Message;
    	$m->user_id = $request->sender;
    	$m->reciever_id = $request->reciever;
    	$m->message = $request->message;
    	if ($m->save()) {
    		return 1;
    	}else{
			return 0;    	   
    	}
    }

    public function getconversation($sender_id,$reciever_id)
    {
         // DB::enableQueryLog();
    	 $data = DB::table('messages')
    	  ->select(DB::raw('u.id as current_id, r.id as reciever_id, messages.message,u.firstname as current_firstname,u.middlename as current_middlename,u.lastname as current_lastname,u.profilepic as current_profilepic,r.firstname as reciever_firstname,r.middlename as reciever_middlename,r.lastname as reciever_lastname,r.profilepic as reciever_profilepic,messages.created_at'))
         ->leftJoin('users as u', 'u.id', '=', 'messages.user_id')
         ->leftJoin('users as r', 'r.id', '=', 'messages.reciever_id')
         ->where('messages.user_id', '=', $sender_id)
         ->where('messages.reciever_id', '=', $reciever_id)
         ->orWhere('messages.reciever_id', '=', $sender_id)
         ->where('messages.user_id', '=', $reciever_id)
         ->orderBy('messages.id', 'asc')
         ->get();
         // dd(DB::getQueryLog());
         return $data;
    }


    public function getMessageSender($user_id)
    {
         // DB::enableQueryLog();
         $data = DB::table('messages')
          ->select(DB::raw('u.id as current_id, r.id as reciever_id, messages.message,u.firstname as current_firstname,u.middlename as current_middlename,u.lastname as current_lastname,u.profilepic as current_profilepic,r.firstname as reciever_firstname,r.middlename as reciever_middlename,r.lastname as reciever_lastname,r.profilepic as reciever_profilepic,messages.created_at'))
         ->leftJoin('users as u', 'u.id', '=', 'messages.user_id')
         ->leftJoin('users as r', 'r.id', '=', 'messages.reciever_id')
         ->where('messages.user_id', '=', $user_id)
         ->orWhere('messages.reciever_id', '=', $user_id)
         ->orderBy('messages.id', 'asc')
         ->get();
         // dd(DB::getQueryLog());
         return $data;
    }
}
