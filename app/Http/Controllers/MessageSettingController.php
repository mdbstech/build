<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\MessageSetting;

class MessageSettingController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
    	$message_setting = MessageSetting::first();
    	return view('message_setting.edit',compact('message_setting'));
    }

    public function update(Request $request, MessageSetting $message_setting)
    {
        $this->validate($request, [
           	'url' => 'required|max:50',
            'auth_key' => 'required|max:50',
            'promotional_route' => 'required|max:1',
            'transactional_route' => 'required|max:1',
            'promotional_sender' => 'required|max:6',
            'transactional_sender' => 'required|max:6',
            'country' => 'required|max:50',
          
        ]);
        MessageSetting::where('message_setting_id',$message_setting->message_setting_id)->update([
            'url' => $request['url'],
            'auth_key' => $request['auth_key'],
            'promotional_route' => $request['promotional_route'],
            'transactional_route' => $request['transactional_route'],
            'promotional_sender' => $request['promotional_sender'],
            'transactional_sender' => $request['transactional_sender'],
            'country' => $request['country'],  
            'updated_by' => Auth::User()->username,         
        ]);

        return redirect('/message_setting/edit/')->with('success-message', 'MessageSetting is successfully updated...!');
    }
}
