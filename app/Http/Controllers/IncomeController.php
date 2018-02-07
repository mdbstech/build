<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Income;

use App\Account;

use App\Contact;

use App\Master;

class IncomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        $id = Income::count();
        $receipt_no = $id + 1;
        $length = strlen($receipt_no);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++) 
        { 
            $receipt_no = '0'.$receipt_no;
        }
		$incomes = Income::paginate(10);
		$accounts = Account::get();
		$contacts = Contact::get();
		$payment_modes = Master::where('master_name','Payment Mode')->get();
        return view('income.create',compact('incomes','accounts','contacts','payment_modes','receipt_no'));
    }
     public function store(Request $request)
    {
        $this->validate($request, [
            'receipt_no' => 'required|max:50',
            'receipt_date' => 'required|date',
            'income_account' => 'required|numeric',
            'deposit_to' => 'required|numeric',
            'contact_id' => 'required|numeric',
            'payment_mode' => 'required|max:50',
            'amount' => 'required|numeric',
            'note' => 'max:2550',
        ]);

        $income = Income::create([
            'receipt_no' => $request['receipt_no'],
            'receipt_date'=> date("Y-m-d", strtotime($request['receipt_date'])),
            'income_account' => $request['income_account'],
            'deposit_to' => $request['deposit_to'],
            'contact_id' => $request['contact_id'],
            'payment_mode' => $request['payment_mode'],
            'amount' => $request['amount'],
            'note' => $request['note'],
            'created_by' => Auth::User()->username,         
        ]);

        if($request->hasFile('files'))
        {
            $files = $request->file('files');
            $name='';
            $i = 1;
            foreach ($files as $file) 
            {
                $filename = $i . '-' . $income->income_id . '.' . $file->getClientOriginalExtension();
                $file->storeAs('Income',$filename);
                $name = $filename.','.$name;
                $i = $i+1;
            }
            Income::where('income_id',$income->income_id)->update([
                'files' => $name,
            ]);
        }
        return redirect('/income/create/')->with('success-message', 'Income '.$income->receipt_no.' is successfully created...!');
    }
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required'
        ]);
        $id = Income::count();
        $receipt_no = $id + 1;
        $length = strlen($receipt_no);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++) 
        { 
            $receipt_no = '0'.$receipt_no;
        }
        $accounts = Account::get();
        $contacts = Contact::get();
        $payment_modes = Master::where('master_name','Payment Mode')->get();
        $incomes = Income::
              where('receipt_no', 'like', "%$request->search%")
            ->orWhere('receipt_date', 'like', "%$request->search%")
            ->orWhereHas('IncomeAccount', function($query) use($request){
                $query->where('account_name','like','%'.$request->search.'%');
            })
            ->orWhereHas('DepositTo', function($query) use($request){
                $query->where('account_name','like','%'.$request->search.'%');
            })
            ->orWhereHas('Contact', function($query) use($request){
                $query->where('contact_name','like','%'.$request->search.'%');
            })
            ->orWhere('amount', 'like', "%$request->search%")
            ->orWhere('note', 'like', "%$request->search%")
            ->paginate(10)
            ->appends(['search' => $request->search]);
        return view('income.create',compact('accounts','contacts','payment_modes','incomes','receipt_no'));
    }
    public function edit(Request $request, Income $income)
	{
        
        $incomes = Income::paginate(10);
		$accounts = Account::get();
		$contacts = Contact::get();
		$payment_modes = Master::where('master_name','Payment Mode')->get();
        return view('income.edit',compact('incomes','accounts', 'contacts','payment_modes','income'));
	}

	public function update(Request $request, Income $income)
	{
    	$this->validate($request, [
            'receipt_no' => 'required|max:50',
            'receipt_date' => 'required|date',
            'income_account' => 'required|numeric',
            'deposit_to' => 'required|numeric',
            'contact_id' => 'required|numeric',
            'payment_mode' => 'required|max:50',
            'amount' => 'required|numeric',
            'note' => 'max:2550',
           
        ]);
        Income::where('income_id',$income->income_id)->update([
            'receipt_no' => $request['receipt_no'],
            'receipt_date'=> date("Y-m-d", strtotime($request['receipt_date'])),
            'income_account' => $request['income_account'],
            'deposit_to' => $request['deposit_to'],
            'contact_id' => $request['contact_id'],
            'payment_mode' => $request['payment_mode'],
            'amount' => $request['amount'],
            'note' => $request['note'],
            'updated_by' => Auth::User()->username,         
        ]);

        if($request->hasFile('files'))
        {
            $files = $request->file('files');
            $name='';
            $i = 1;
            foreach ($files as $file) 
            {
                $filename = $i . '-' . $income->income_id . '.' . $file->getClientOriginalExtension();
                $file->storeAs('Income',$filename);
                $name = $filename.','.$name;
                $i = $i+1;
            }
            Income::where('income_id',$income->income_id)->update([
                'files' => $name,
            ]);
        }

        return redirect('/income/create/')->with('success-message', 'Income '.$income->receipt_no.' is successfully updated...!');
	}
	public function delete(Request $request)
        {
            Income::where('income_id',$request->income_id)->delete();
        }

}
