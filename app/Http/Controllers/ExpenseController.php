<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Contact;

use App\Account;

use App\Expense;

use App\Master;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        $id = Expense::count();
        $voucher_no = $id + 1;
        $length = strlen($voucher_no);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++) 
        { 
            $voucher_no = '0'.$voucher_no;
        }
		$expenses = Expense::paginate(10);
		$accounts = Account::get();
		$contacts = Contact::get();
		$payment_modes = Master::where('master_name','Payment Mode')->get();
        return view('expense.create',compact('expenses','accounts','contacts','payment_modes','voucher_no'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'voucher_no' => 'required|max:50',
            'voucher_date' => 'required|date',
            'expense_account' => 'required|numeric',
            'paid_through' => 'required|numeric',
            'contact_id' => 'required|numeric',
            'payment_mode' => 'required|max:50',
            'amount' => 'required|numeric',
            'note' => 'max:2550',
        ]);

        $expense = Expense::create([
            'voucher_no' => $request['voucher_no'],
            'voucher_date'=> date("Y-m-d", strtotime($request['voucher_date'])),
            'expense_account' => $request['expense_account'],
            'paid_through' => $request['paid_through'],
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
                $filename = $i . '-' . $expense->expense_id . '.' . $file->getClientOriginalExtension();
                $file->storeAs('Expense',$filename);
                $name = $filename.','.$name;
                $i = $i+1;
            }
            Expense::where('expense_id',$expense->expense_id)->update([
                'files' => $name,
            ]);
        }

       return redirect('/expense/create/')->with('success-message', 'Expense '.$expense->voucher_no.' is successfully created...!');
    }
     public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required'
        ]);
        $id = Expense::count();
        $voucher_no = $id + 1;
        $length = strlen($voucher_no);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++) 
        { 
            $voucher_no = '0'.$voucher_no;
        }
        $accounts = Account::get();
        $contacts = Contact::get();
        $payment_modes = Master::where('master_name','Payment Mode')->get();
        $expenses = Expense::
              where('voucher_no', 'like', "%$request->search%")
            ->orWhere('voucher_date', 'like', "%$request->search%")
            ->orWhereHas('ExpenseAccount', function($query) use($request){
                $query->where('account_name','like','%'.$request->search.'%');
            })
            ->orWhereHas('PaidThrough', function($query) use($request){
                $query->where('account_name','like','%'.$request->search.'%');
            })
            ->orWhereHas('Contact', function($query) use($request){
                $query->where('contact_name','like','%'.$request->search.'%');
            })
            ->orWhere('payment_mode', 'like', "%$request->search%")
            ->orWhere('amount', 'like', "%$request->search%")
            ->orWhere('note', 'like', "%$request->search%")
            ->paginate(10)
            ->appends(['search' => $request->search]);
        return view('expense.create',compact('accounts','contacts','payment_modes','expenses','voucher_no'));
    }
    public function edit(Request $request, Expense $expense)
	{
        
        $expenses = Expense::paginate(10);
		$accounts = Account::get();
		$contacts = Contact::get();
		$payment_modes = Master::where('master_name','Payment mode')->get();
        return view('expense.edit',compact('expenses','accounts', 'contacts','payment_modes','expense'));
	}
	public function update(Request $request, Expense $expense)
	{
    	$this->validate($request, [
            'voucher_no' => 'required|max:50',
            'voucher_date' => 'required|date',
            'expense_account' => 'required|numeric',
            'paid_through' => 'required|numeric',
            'contact_id' => 'required|numeric',
            'payment_mode' => 'required|max:50',
            'amount' => 'required|numeric',
            'note' => 'max:2550',
           
        ]);
        Expense::where('expense_id',$expense->expense_id)->update([
            'voucher_no' => $request['voucher_no'],
            'voucher_date'=> date("Y-m-d", strtotime($request['voucher_date'])),
            'expense_account' => $request['expense_account'],
            'paid_through' => $request['paid_through'],
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
                $filename = $i . '-' . $expense->expense_id . '.' . $file->getClientOriginalExtension();
                $file->storeAs('Expense',$filename);
                $name = $filename.','.$name;
                $i = $i+1;
            }
            Expense::where('expense_id',$expense->expense_id)->update([
                'files' => $name,
            ]);
        }

        return redirect('/expense/create/')->with('success-message', 'Expense '.$expense->voucher_no.' is successfully updated...!');
	}
	public function delete(Request $request)
        {
            Expense::where('expense_id',$request->expense_id)->delete();
        }
}
