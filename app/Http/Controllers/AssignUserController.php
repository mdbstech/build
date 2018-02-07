<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\AssignUser;

use App\User;

use App\Contact;

class AssignUserController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function create(Contact $contact)
  {
      $assign_users = AssignUser::where('contact_id',$contact->contact_id)->paginate(10);
      $users = User::get();
      $contacts = Contact::get();
      return view('assign_user.create',compact('assign_users','users','contacts','contact'));
  }
  public function store(Request $request)
  {
      $this->validate($request, [
          'user_id' => 'required|numeric',
          'contact_id' => 'required|numeric',
          'assign_date' => 'required|max:50',
          'note' => 'max:2550',
      ]);

      $assign_user = AssignUser::create([
          'user_id' => $request['user_id'],
          'contact_id' => $request['contact_id'],
          'assign_date' => $request['assign_date'],
          'note' => $request['note'],
          'created_by' => Auth::User()->username,
      ]);

      return redirect('/assign_user/create/'.$assign_user->contact_id)->with('success-message', 'AssignUser '.$assign_user->user_id.' is successfully Created...!');
  }
  public function edit(AssignUser $assign_user)
      {
          $assign_users = AssignUser::where('contact_id',$assign_user->contact_id)->paginate(10);
          $users = User::get();
          $contacts = Contact::get();
          return view('assign_user.edit',compact('assign_users','users','contacts','assign_user'));
      }
      public function update(Request $request, AssignUser  $assign_user)
      {
            $this->validate($request, [
              'user_id' => 'required|numeric',
              'contact_id' => 'required|numeric',
              'assign_date' => 'required|max:50',
              'note' => 'max:2550',
            ]);

            AssignUser::where('assign_id',$assign_user->assign_id)->update([
              'user_id' => $request['user_id'],
              'contact_id' => $request['contact_id'],
              'assign_date' => $request['assign_date'],
              'note' => $request['note'],
              'updated_by' => Auth::User()->username,

              ]);

          return redirect('/assign_user/create/'.$assign_user->contact_id)->with('success-message', 'AssignUser '.$assign_user->user_id.' is successfully Updated...!');
       }
       public function delete(Request $request)
       {
           AssignUser::where('assign_id',$request->assign_id)->delete();
       }
      /* public function search(Request $request)
    {
       $this->validate($request, [
           'search' => 'required'
       ]);

       $users = User::get();
       $contacts = Contact::get();
       $assign_users = AssignUser::
           whereHas('User', function($query) use($request){
               $query->where('username','like','%'.$request->search.'%');
           })
           ->orWhereHas('Contact', function($query) use($request){
               $query->where('contact_name','like','%'.$request->search.'%');
           })
           ->orWhere('note', 'like', "%$request->search%")
           ->paginate(10)
           ->appends(['search' => $request->search]);
       return view('assign_user.create',compact('assign_users','users','contacts
        '));
    }*/

}
