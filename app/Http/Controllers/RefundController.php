<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
use App\Contact;
use App\Refund;
use App\Master;
use App\Payment;
use App\SiteAllotment;
use Auth;

class RefundController extends Controller
{
	public function __construct()
  {
      $this->middleware('auth');
  }

    public function create(SiteAllotment $site_allotment)
    {
        $id = Refund::max('refund_id');
        $voucher_no = $id + 1;
        $length = strlen($voucher_no);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++) 
        { 
            $voucher_no = '0'.$voucher_no;
        }

    	$refunds=Refund::where('site_allotment_id',$site_allotment->site_allotment_id)->paginate(10);
    	$payment_modes=Master::where('master_name','Payment Mode')->get();
        $contact = Contact::where('contact_id', $site_allotment->contact_id)->first();
        $payments = Payment::where('site_allotment_id','$site_allotment->site_allotment_id')->get();
        $refund = Payment::where('site_allotment_id',$site_allotment->site_allotment_id)->sum('amount') - $site_allotment->amount;
        $refund_amount = $refund - Refund::where('site_allotment_id',$site_allotment->site_allotment_id)->sum('amount');
        return view('refund.create',compact('refunds', 'voucher_no', 'payment_modes', 'contact','site_allotment','refund_amount'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'contact_id' => 'required|numeric',
            'site_allotment_id'=> 'numeric',
            'voucher_no'=>'required|max:50',
            'payment_mode' => 'required|max:50',
            'amount' => 'required|numeric',
          
        ]);
        
    	$refund = Refund::create([
            'contact_id' => $request['contact_id'],
            'site_allotment_id'=> $request['site_allotment_id'],
            'voucher_no' => $request['voucher_no'],
            'voucher_date' => date('Y-m-d', strtotime($request->voucher_date)),
            'payment_mode' => $request['payment_mode'],
            'date' => date('Y-m-d', strtotime($request->date)),
            'num' => $request['num'],
            'amount' => $request['amount'],
            'created_by' => Auth::User()->username,         
        ]);

        return redirect('/contact/view/'.$refund->contact_id)->with('success-message', 'Refund '.$refund->refund_id.' is successfully created...!');
    }
     public function delete(Request $request)
    {
    	$refundss = Refund::where('refund_id',$request->refund_id)->delete();
    }
    public function Edit(Request $request,Refund $refund)
    {
    	
    	$refunds=Refund::where('site_allotment_id',$refund->site_allotment_id)->paginate(10);
    	$contacts = Contact::where('contact_type','Member')->get();
    	$payment_modes = Master::where('master_name','Payment Mode')->get();
        $site_allotment = SiteAllotment::where('site_allotment_id',$refund->site_allotment_id)->first();
        $payments = Payment::where('site_allotment_id','$site_allotment->site_allotment_id')->first();
        $refund_amount = Payment::where('site_allotment_id',$refund->site_allotment_id)->sum('amount') - $site_allotment->amount;
    	return view('refund.edit',compact('contacts','sites','refunds','payment_modes','refund','refund_amount','site_allotment'));
    }

    public function update(Request $request,Refund $refund)
    {
    	$this->validate($request, [
            'contact_id' => 'required|numeric',
            'site_allotment_id' => 'numeric',
            'voucher_no'=>'required|max:50',
            'payment_mode' => 'required|max:50',
            'amount' => 'required|numeric',
          
      ]);
        

    	Refund::where('refund_id',$refund->refund_id)->update([
    	    'contact_id' => $request['contact_id'],
            'site_allotment_id' => $request['site_allotment_id'],
            'voucher_no' => $request['voucher_no'],
            'voucher_date' => date('Y-m-d', strtotime($request->voucher_date)),
            'payment_mode' => $request['payment_mode'],
            'date' => date('Y-m-d', strtotime($request->date)),
            'num' => $request['num'],
            'amount' => $request['amount'],
            'updated_by' => Auth::User()->username, 
    		]);
    	return redirect('/contact/view/'.$refund->contact_id)->with('success-message', 'Refund '.$refund->voucher_no.' is successfully updated...!');

    }
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required'
        ]);
        
        $id = Refund::count();
        $voucher_no = $id + 1;
        $length = strlen($voucher_no);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++) 
        { 
            $voucher_no = '0'.$voucher_no;
        }
    	$contacts = Contact::where('contact_type','Member')->get();
    	$payment_modes = Master::where('master_name','Payment Mode')->get();
        $refunds = Refund::
              where('amount', 'like', "%$request->search%")  
            ->orWhereHas('Contact', function($query) use($request){
                $query->where('contact_name','like','%'.$request->search.'%');
            })
             ->orWhere('voucher_no', 'like', "%$request->search%")
            ->orWhere('payment_mode', 'like', "%$request->search%")
            ->paginate(10)
            ->appends(['search' => $request->search]);
        return view('refund.display',compact('payment_modes','voucher_no','refunds','contacts'));
    }
     public function display()
    {
        $refunds = Refund::paginate(10);
        return view('refund.display',compact('refunds','contact'));
    }

}
