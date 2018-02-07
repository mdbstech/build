<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Payment;

use App\Site;

use App\Contact;

use App\Master;

use App\SiteAllotment;

use App\Organization;


class PaymentController extends Controller
{

	public function __construct()
  {
      $this->middleware('auth');
  }
    public function create(SiteAllotment $site_allotment)
    {
    	$id = Payment::max('payment_id');
        $receipt_no = $id + 1;
        $length = strlen($receipt_no);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++) 
        { 
            $receipt_no = '0'.$receipt_no;
        }
    	$payments=Payment::where('site_allotment_id',$site_allotment->site_allotment_id)->paginate(10);
    	$payment_modes = Master::where('master_name','Payment Mode')->get();
        $due_amount = $site_allotment->amount - Payment::where('site_allotment_id',$site_allotment->site_allotment_id)->sum('amount');
        $contact = Contact::where('contact_id', $site_allotment->contact_id)->first();

    	return view('payment.create',compact('payments', 'receipt_no','payment_modes','contact','site_allotment', 'due_amount'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
          'contact_id' => 'required|numeric',
          'site_allotment_id' => 'numeric',
          'receipt_no' => 'required|max:20',
          'receipt_date' => 'required|date',
          'payment_mode' => 'required|max:50',
          'amount' => 'required|numeric',
          
      ]);
        
    	$payment = Payment::create([
            'contact_id' => $request['contact_id'],
            'site_allotment_id' => $request->site_allotment_id,
            'receipt_no' => $request['receipt_no'],
            'receipt_date' => date('Y-m-d', strtotime($request->receipt_date)),
            'payment_mode' => $request['payment_mode'],
            'date' => date('Y-m-d', strtotime($request->date)),
            'num' => $request['num'],
            'amount' => $request['amount'],
            'created_by' => Auth::User()->username,         
        ]);

        return redirect('/contact/view/'.$payment->contact_id)->with('success-message', 'Payment '.$payment->receipt_no.' is successfully created...!');
    }

    public function Edit(Request $request,Payment $payment)
    {
    	
    	$payments=Payment::where('site_allotment_id',$payment->site_allotment_id)->paginate(10);
        $site_allotment = SiteAllotment::where('contact_id',$payment->contact_id)->whereNull('site_id')->first();
        $due_amount = $site_allotment->amount - Payment::where('site_allotment_id',$payment->site_allotment_id)->sum('amount');
    	$contacts = Contact::where('contact_type','Member')->get();
    	$payment_modes = Master::where('master_name','Payment Mode')->get();
    	return view('payment.edit',compact('contacts','payments','payment_modes','payment','due_amount','site_allotment'));
    }

    public function update(Request $request,Payment $payment)
    {
    	$this->validate($request, [
          'contact_id' => 'required|numeric',
          'site_allotment_id' => 'numeric',
          'receipt_no' => 'required|max:20',
          'receipt_date' => 'required|date',
          'payment_mode' => 'required|max:50',
          'amount' => 'required|numeric',
          
      ]);
        
        $site_allotment = SiteAllotment::where('contact_id', $request->contact_id)->whereNull('site_id')->first();

    	Payment::where('payment_id',$payment->payment_id)->update([
    		'contact_id' => $request['contact_id'],
            'site_allotment_id' => $site_allotment['site_allotment_id'],
            'receipt_no' => $request['receipt_no'],
            'receipt_date' => date('Y-m-d', strtotime($request->receipt_date)),
            'payment_mode' => $request['payment_mode'],
            'date' => date('Y-m-d', strtotime($request->date)),
            'num' => $request['num'],
            'amount' => $request['amount'],
            'updated_by' => Auth::User()->username, 
    		]);
    	return redirect('/contact/view/'.$payment->contact_id)->with('success-message', 'Payment '.$payment->receipt_no.' is successfully created...!');

    }

    public function delete(Request $request)
    {
    	$payments = Payment::where('payment_id',$request->payment_id)->delete();
    }
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required'
        ]);
        $id = Payment::count();
        $receipt_no = $id + 1;
        $length = strlen($receipt_no);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++) 
        { 
            $receipt_no = '0'.$receipt_no;
        }
        
    	
    	$contacts = Contact::where('contact_type','Member')->get();
    	$payment_modes = Master::where('master_name','Payment Mode')->get();
        $payments = Payment::
              where('receipt_no', 'like', "%$request->search%") 
               ->orWhere('receipt_date', 'like', "%$request->search%") 
            ->orWhereHas('Contact', function($query) use($request){
                $query->where('contact_name','like','%'.$request->search.'%');
            })
              ->orWhere('date', 'like', "%$request->search%")
                ->orWhere('num', 'like', "%$request->search%")
            ->orWhere('amount', 'like', "%$request->search%")
            ->orWhere('payment_mode', 'like', "%$request->search%")
            ->paginate(10)
            ->appends(['search' => $request->search]);
        return view('payment.display',compact('payment_modes','payments','contacts','receipt_no'));
    }

    public function display()
    {
        $payments = Payment::paginate(10);
        return view('payment.display',compact('payments','contact'));
    }
    public function payment_report(Request $request)
    {

        $org = Organization::first();
        $contacts = Contact::where('contact_type','<>','Member')->get();
        $from_date = date('d-m-Y');
        $to_date = date('d-m-Y');
        $payments = Payment::get();
        if($request->input())
        {
            $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required',
            
            ]);
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $report_type = $request->report_type;
            $contact_id = $request->contact_id;

            if($request->contact_id == '')
            {
                $payments = Payment::whereBetween('receipt_date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])->get();
            }
            else
            {
                $payments = Payment::whereBetween('receipt_date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])->where('contact_id',$request->contact_id)->get();
            }
        } 
        else
        {
            $payments = Payment::whereBetween('receipt_date', [date('Y-m-d',strtotime($from_date)), date('Y-m-d',strtotime($to_date))])->get();
        }    
        return view('payment.payment_report', compact('org', 'from_date', 'to_date', 'payments', 'report_type','contacts'));
    }
}
