<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\User;

use App\Contact;

use App\AssignUser;

use App\FollowUp;

use App\Ticket;

//use Image;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
      $users = User::paginate(10);
      return view('user.create',compact('users'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:50',
            'name' => 'required|max:50',
            'email' => 'required|max:50:email',
            'password' => 'required',
            'user_role'=>'required|max:50',
            'mobile_no' => 'required|min:10|max:10',
            'phone_no' => 'max:50',
            'address1' => 'required|max:255',
            'address2' => 'max:255',
            'city' => 'required|max:50',
            'state' => 'required|max:50',
            'country' => 'required|max:50',
            'zipcode' => 'required|max:50',

        ]);

        $user = User::create([
            'username' => $request['username'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request->password),
            'user_role'=>$request['user_role'],
            'mobile_no' => $request['mobile_no'],
            'phone_no' => $request['phone_no'],
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'city' => $request['city'],
            'state' => $request['state'],
            'country' => $request['country'],
            'zipcode' => $request['zipcode'],
            'avatar' => $request['avatar'],
            'created_by' => Auth::User()->username,
        ]);
        
        if($request->hasFile('avatar'))
        {
            $file = $request->file('avatar');
            $filename ='Avatar-'. $user->user_id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('User',$filename);

            User::where('user_id',$user->user_id)->update([
                'avatar' => $filename,
            ]);
        }

        return redirect('/user/create/')->with('success-message', 'User '.$user->username.' is successfully Created...!');
    }
    public function edit(User $user)
    {
        $users = User::paginate(10);
        return view('user.edit',compact('users','user'));
    }
    public function update(Request $request, User  $user)
    {
        $this->validate($request, [
            'username' => 'required|max:50',
            'name' => 'required|max:50',
            'email' => 'required|max:50|email', 
            'user_role'=>'required|max:50',
            'mobile_no' => 'required|min:10|max:10',
            'phone_no' => 'max:50',
            'address1' => 'required|max:255',
            'address2' => 'max:255',
            'city' => 'required|max:50',
            'state' => 'required|max:50',
            'country' => 'required|max:50',
            'zipcode' => 'required|max:50',

        ]);
        User::where('user_id',$user->user_id)->update([
            'username' => $request['username'],
            'name' => $request['name'],
            'email' => $request['email'],   
            'user_role'=>$request['user_role'],
            'mobile_no' => $request['mobile_no'],
            'phone_no' => $request['phone_no'],
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'city' => $request['city'],
            'state' => $request['state'],
            'country' => $request['country'],
            'zipcode' => $request['zipcode'],
            'avatar' => $request['avatar'],
            'updated_by' => Auth::User()->username,

        ]);
        if($request->hasFile('avatar'))
        {
            $file = $request->file('avatar');
            $filename ='Avatar-'. $user->user_id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('User',$filename);

            User::where('user_id',$user->user_id)->update([
                'avatar' => $filename,
            ]);
        }


        return redirect('/user/create/')->with('success-message', 'User '.$user->username.' is successfully Updated...!');

    }
    public function delete(Request $request)
    {
        User::where('user_id',$request->user_id)->delete();
    }
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required'
        ]);

        $users = User::
            where('username', 'like', "%$request->search%")
            ->orWhere('name', 'like', "%$request->search%")
            ->orWhere('email', 'like', "%$request->search%")
            ->orWhere('mobile_no', 'like', "%$request->search%")
            ->orWhere('phone_no', 'like', "%$request->search%")
            ->orWhere('address1', 'like', "%$request->search%")
            ->orWhere('address2', 'like', "%$request->search%")
            ->orWhere('city', 'like', "%$request->search%")
            ->orWhere('state', 'like', "%$request->search%")
            ->orWhere('country', 'like', "%$request->search%")
            ->orWhere('zipcode', 'like', "%$request->search%")
            ->orWhere('avatar', 'like', "%$request->search%")
            ->orWhere('user_role', 'like', "%$request->search%")
            ->paginate(10)
            ->appends(['search' => $request->search]);
        return view('user.create',compact('users'));
    }
    public function view(User $user)
    {
        $contacts = Contact::where('user_id',$user->user_id)->paginate(10);
        return view('user.view',compact('user','contacts'));
    }
    public function get_user(Request $request)
    {
        return User::where('user_id',$request->user_id)->first();
    }

    public function save_user(Request $request,User $user)
    {

        $this->validate($request, [
            'username' => 'required|max:50',
            'name' => 'required|max:50',
            'email' => 'required|max:50', 
            'user_role'=>'required|max:50',
            'mobile_no' => 'required|max:10',
            'phone_no' => 'max:50',
            'address1' => 'required|max:255',
            'address2' => 'max:255',
            'city' => 'required|max:50',
            'state' => 'required|max:50',
            'country' => 'required|max:50',
            'zipcode' => 'required|max:50',
            
        ]);

        $user = User::create([
            'username' => $request['username'],
            'password' => $request['username'],
            'name' => $request['name'],
            'email' => $request['email'],   
            'user_role'=>$request['user_role'],
            'mobile_no' => $request['mobile_no'],
            'phone_no' => $request['phone_no'],
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'city' => $request['city'],
            'state' => $request['state'],
            'country' => $request['country'],
            'zipcode' => $request['zipcode'],
            'updated_by' => Auth::User()->username,

        ]);
        return response()->json($user);
    }

    public function profile(User $user)
    {
        $contacts = Contact::where('user_id',$user->user_id)->paginate(10);
        return view('user.profile',compact('contacts','user'));
    }



       public function update_profile(Request $request, User  $user)
    {


        if($request->password == '')
        {
            $this->validate($request, [
                'username' => 'required|max:50',
                'name' => 'required',
                'email' => 'required',
                'mobile_no' => 'required|min:10|max:10',
            ]);
            User::where('user_id',$user->user_id)->update([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
            ]);

            if($request->hasFile('avatar'))
            {
            $file = $request->file('avatar');
            $filename ='Avatar-'. $user->user_id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('User',$filename);

            User::where('user_id',$user->user_id)->update([
                'avatar' => $filename,
            ]);
            }
        }
        else
        {
            $this->validate($request, [
                'username' => 'required|max:50',
                'name' => 'required',
                'email' => 'required',
                'mobile_no' => 'required|min:10|max:10',
                'password' => 'required|min:6|confirmed',
                'password' => 'required|min:6|confirmed',
            ]);

            User::where('user_id',$user->user_id)->update([
                'username' => $request->username,
                'name' => $request->name,
                'email'=> $request->email,
                'mobile_no' => $request->mobile_no,
                'password' => bcrypt($request->password),
            ]);

            if($request->hasFile('avatar'))
            {
            $file = $request->file('avatar');
            $filename ='Avatar-'. $user->user_id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('User',$filename);

            User::where('user_id',$user->user_id)->update([
                'avatar' => $filename,
            ]);
            }
        }

       return redirect('/user/profile/')->with('success-message', 'User '.$user->username.' is successfully Updated...!');

    }

}
