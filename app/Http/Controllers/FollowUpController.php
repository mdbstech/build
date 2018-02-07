<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\FollowUp;

use App\Contact;

class FollowUpController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function create(Contact $contact)
  {
      $follow_ups = FollowUp::where('contact_id',$contact->contact_id)->paginate(10);
      $contacts = Contact::get();
      return view('follow_up.create',compact('follow_ups','contacts','contact'));
  }
  public function store(Request $request)
  {
      $this->validate($request, [
          'contact_id' => 'required|numeric',
          'date' => 'required|max:50',
          'time' => 'required|max:50',
          'follow_up_description' => 'max:2550',
          'note' => 'max:2550',
      ]);

      $follow_up = FollowUp::create([
          'contact_id' => $request['contact_id'],
          'date' => $request['date'],
          'time' => $request['time'],
          'follow_up_description' => $request['follow_up_description'],
          'note' => $request['note'],
          'created_by' => Auth::User()->username,
      ]);

      return redirect('/follow_up/create/'.$follow_up->contact_id)->with('success-message', 'FollowUp '.$follow_up->contact_id.' is successfully Created...!');
  }
  public function edit(FollowUp $follow_up)
      {
          $follow_ups = FollowUp::where('contact_id',$follow_up->contact_id)->paginate(10);
          $contacts = Contact::get();
          return view('follow_up.edit',compact('follow_ups','contacts','follow_up'));
      }
      public function update(Request $request, FollowUp  $follow_up)
      {
            $this->validate($request, [
              'contact_id' => 'required|numeric',
              'date' => 'required|max:50',
              'time' => 'required|max:50',
              'follow_up_description' => 'max:2550',
              'note' => 'max:2550',
            ]);

          FollowUp::where('follow_id',$follow_up->follow_id)->update([
              'contact_id' => $request['contact_id'],
              'date' => $request['date'],
              'time' => $request['time'],
              'follow_up_description' => $request['follow_up_description'],
              'note' => $request['note'],
              'updated_by' => Auth::User()->username,

              ]);

          return redirect('/follow_up/create/'.$follow_up->contact_id)->with('success-message', 'FollowUp '.$follow_up->contact_id.' is successfully Updated...!');
       }
       public function delete(Request $request)
       {
           FollowUp::where('follow_id',$request->follow_id)->delete();
       }
     /*  public function search(Request $request)
    {
       $this->validate($request, [
           'search' => 'required'
       ]);

       $contacts = Contact::get();
       $follow_ups = FollowUp::
           where('date', 'like', "%$request->search%")
           ->orWhereHas('Contact', function($query) use($request){
               $query->where('contact_name','like','%'.$request->search.'%');
           })
           ->orWhere('time', 'like', "%$request->search%")
           ->orWhere('follow_up_description', 'like', "%$request->search%")
           ->orWhere('note', 'like', "%$request->search%")
           ->paginate(10)
           ->appends(['search' => $request->search]);
       return view('follow_up.create',compact('follow_ups','contacts'));
    }*/

    public function view(FollowUp $follow_up)
    {
        return view('follow_up.view',compact('follow_up'));
    }
}
