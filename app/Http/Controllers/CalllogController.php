<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Calllog;

use App\Contact;

use App\User;

class CalllogController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth');
    }

      public function create(Contact $contact)
    {
     
        $calllogs = Calllog::where('contact_id',$contact->contact_id)->paginate(10);
        $contacts = Contact::where('contact_type','Lead')->get();
        $agents = User::where('user_role','Agent')->get();
        return view('calllog.create',compact('calllogs','contacts','agents','contact'));
    }

     public function store(Request $request)
    {
        $this->validate($request, [
            'contact_id' => 'required|max:50',
            'user_id' => 'required|max:50',
            'call_log' => 'required|date',
            'note' => '',
            'followup_date'=>'required|date',
            'reference_type'=>'required|max:50',
        ]);

        $calllog = Calllog::create([
            'contact_id' => $request['contact_id'],
            'user_id' => $request['user_id'],
            'call_log' => date("Y-m-d H:i:s", strtotime($request['call_log'])),
            'note' => $request['note'],
            'followup_date' => date("Y-m-d H:i:s", strtotime($request['followup_date'])),
            'reference_type' => $request['reference_type'],
            'created_by' => Auth::User()->username,
        ]);
      

         return redirect('/calllog/create/'.$calllog->contact_id)->with('success-message', 'Calllog '.$calllog->contact_id.' is successfully Created...!');
    }

    public function edit(Calllog $calllog)
        {
        	$calllogs = Calllog::where('contact_id',$calllog->contact_id)->paginate(10);
            $contacts = Contact::where('contact_type','Lead')->get();
            $agents = User::where('user_role','Agent')->get();
        	return view('calllog.edit',compact('calllogs','contacts','agents','calllog'));
            
        }

            public function update(Request $request, Calllog  $calllog)
        {
        	$this->validate($request, [
                'contact_id' => 'required|max:50',
                'user_id' => 'required|max:50',
                'call_log' => 'required|date',
                'note' => '',
                'followup_date'=>'required|date',
                'reference_type'=>'required|max:50',
                
            ]);

            Calllog::where('calllog_id',$calllog->calllog_id)->update([
                'contact_id' => $request['contact_id'],
                'user_id' => $request['user_id'],
                'call_log' => date("Y-m-d H:i:s", strtotime($request['call_log'])),
                'note' => $request['note'],
                'followup_date' => date("Y-m-d H:i:s", strtotime($request['followup_date'])),
                'reference_type' => $request['reference_type'],
            	'updated_by' => Auth::User()->username,

            	]);

            

            return redirect('/calllog/create/'.$calllog->contact_id)->with('success-message', 'Calllog '.$calllog->contact_id.' is successfully Updated...!');
        }

    public function search(Request $request)
    
    {
        $this->validate($request, [
            'search' => 'required'
        ]);
       
        $contacts = Contact::where('status','Lead')->get();
        $agents = User::where('user_role','Agent')->get();
        $calllogs = Calllog::
            where('call_log', 'like', "%$request->search%")
            ->orWhereHas('Contact', function($query) use($request){
                $query->where('contact_name','like','%'.$request->search.'%');
            })
            ->orWhereHas('Agent', function($query) use($request){
                $query->where('username','like','%'.$request->search.'%');
            })
            ->orWhere('note', 'like', "%$request->search%")
            ->orWhere('followup_date', 'like', "%$request->search%")
            ->orWhere('reference', 'like', "%$request->search%")
            ->paginate(10)
            ->appends(['search' => $request->search]);
        return view('calllog.create',compact('calllogs','contacts','agents'));
    }

public function delete(Request $request)
        {
            Calllog::where('calllog_id',$request->calllog_id)->delete();
        }
}
