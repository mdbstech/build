<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Account;

use App\AccountType;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        $id = Account::max('account_id');
        $account_code = $id + 1;
        $length = strlen($account_code);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++) 
        { 
            $account_code = '0'.$account_code;
        }
		$accounts = Account::paginate(10);
		$account_types =AccountType::get();
        return view('account.create',compact('accounts','account_types','account_code'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'account_type_id' => 'required',
            'account_code' => 'required|max:50',
            'account_name' => 'required|max:50',
            'account_no' => 'max:50',
            'bank_name' => 'max:50',
            'branch_name' => 'max:50',
            'ifsc_code' => 'max:50',
            'account_description' => 'max:2550',
            'account_status' => 'required',
        ]);
        $account = Account::create([
            'account_type_id' => $request['account_type_id'],
            'account_code' => $request['account_code'],
            'account_name' => $request['account_name'],
            'account_no' => $request['account_no'],
            'bank_name' => $request['bank_name'],
            'branch_name' => $request['branch_name'],
            'ifsc_code' => $request['ifsc_code'],
            'account_description' => $request['account_description'],
            'account_status' => $request['account_status'],
            'created_by' => Auth::User()->username,         
        ]);

        return redirect()->back()->with('success-message', 'Account '.$account->account_name.' is successfully created...!');
    }
    
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required'
        ]);
        $id = Account::max('account_id');
        $account_code = $id + 1;
        $length = strlen($account_code);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++) 
        { 
            $account_code = '0'.$account_code;
        }
        $account_types =AccountType::get();
        $accounts = Account::
            whereHas('AccountType', function($query) use($request){
                $query->where('account_type','like','%'.$request->search.'%')
                      ->orwhere('account_type_description','like','%'.$request->search.'%');
            })
            ->orWhere('account_code', 'like', "%$request->search%")
            ->orWhere('account_name', 'like', "%$request->search%")
            ->orWhere('account_no', 'like', "%$request->search%")
            ->orWhere('account_no', 'like', "%$request->search%")
            ->orWhere('bank_name', 'like', "%$request->search%")
            ->orWhere('branch_name', 'like', "%$request->search%")
            ->orWhere('ifsc_code', 'like', "%$request->search%")
            ->orWhere('account_description', 'like', "%$request->search%")
            ->orWhere('account_status', 'like', "%$request->search%")
            ->paginate(10)
            ->appends(['search' => $request->search]);
        return view('account.create',compact('accounts','account_types','account_code'));
    }
     public function edit(Request $request, Account $account)
    {
        $accounts = Account::paginate(10);
        $account_types=AccountType::get();
        return view('account.edit',compact('accounts','account_types', 'account'));
    }
 	public function update(Request $request, Account $account)
    {
        $this->validate($request, [
            'account_type_id' => 'required',
            'account_code' => 'required|max:50',
            'account_name' => 'required|max:50',
            'account_no' => 'max:50',
            'bank_name' => 'max:50',
            'branch_name' => 'max:50',
            'ifsc_code' => 'max:50',
            'account_description' => 'max:2550',
            'account_status' => 'required',
        ]);
        Account::where('account_id',$account->account_id)->update([
            'account_type_id' => $request['account_type_id'],
            'account_code' => $request['account_code'],
            'account_name' => $request['account_name'],
            'account_no' => $request['account_no'],
            'bank_name' => $request['bank_name'],
            'branch_name' => $request['branch_name'],
            'ifsc_code' => $request['ifsc_code'],
            'account_description' => $request['account_description'],
            'account_status' => $request['account_status'],
            'updated_by' => Auth::User()->username,         
        ]);

        
        return redirect('/account/create/')->with('success-message', 'Account '.$account->account_name.' is successfully updated...!');
    }
    public function delete(Request $request)
        {
            Account::where('account_id',$request->account_id)->delete();
        }

}
