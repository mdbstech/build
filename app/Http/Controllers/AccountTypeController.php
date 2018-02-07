<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\AccountType;

use App\Master;

class AccountTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
    	
		$account_types = AccountType::paginate(10);
        return view('account_type.create',compact('account_types'));
    }
     public function store(Request $request)
    {
        $this->validate($request, [
        	
            'account_type' => 'required|max:50',
            'account_type_description' => 'max:2550',
        ]);

         $account_type = AccountType::create([

            'account_type' => $request['account_type'],
            'account_type_description' => $request['account_type_description'],
            'created_by' => Auth::User()->username,         
        ]);

          return redirect('/account_type/create/')->with('success-message', 'AccountType '.$account_type->account_type.' is successfully Created...!');
    }
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required'
        ]);
        $account_types = AccountType::
            where('account_type', 'like', "%$request->search%")
            ->orWhere('account_type_description', 'like', "%$request->search%")
            ->paginate(10)
            ->appends(['search' => $request->search]);
        return view('account_type.create',compact('account_types'));
    }
    public function edit(AccountType $account_type)
    {
    	
        $account_types = AccountType::paginate(10);
        return view('account_type.edit',compact('account_types','account_type'));
    }
    public function update(Request $request, AccountType $account_type)
    {
        $this->validate($request, [
        	
            'account_type' => 'required|max:50',
            'account_type_description' => 'max:2550',
        ]);
        AccountType::where('account_type_id',$account_type->account_type_id)->update([
        	
            'account_type' => $request['account_type'],
            'account_type_description' => $request['account_type_description'],
            'updated_by' => Auth::User()->username,         
        ]);

        
       return redirect('/account_type/create/')->with('success-message', 'AccountType '.$account_type->account_type.' is successfully updated...!');
    }
    public function delete(Request $request)
        {
            AccountType::where('account_type_id',$request->account_type_id)->delete();
        }


}
