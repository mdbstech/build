<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Organization;
use App\Payment;
use App\Refund;
use App\Society;
use App\Master;
use Auth;

class ReportController extends Controller
{
    public function __construct()
    { 
        $this->middleware('auth');
    }
    public function payment_report(Request $request)
    {

        $org = Organization::first();
        $contacts = Contact::where('contact_type','Member')->get();
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
                $payments = Payment::whereHas('Contact',function($query) use($request){
                    $query->where('contact_type','Member');
                })
                ->orWhereBetween('receipt_date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])->get();
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
        return view('reports.payment_report', compact('org', 'from_date', 'to_date', 'payments', 'report_type','contacts'));
    }

    public function refund_report(Request $request)
    {
        $org = Organization::first();
        $from_date = date('d-m-Y');
        $to_date = date('d-m-Y');
        $refunds = Refund::get();
        $contacts = Contact::where('contact_type','Member')->get();
    	
        if($request->input())
        {
            $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required',
           
            ]);
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $report_type = $request->report_type;

            if($request->contact_id == '')
            {
                $refunds = Refund::whereBetween('voucher_date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])->get();
            }
            else
            {
                $refunds = Refund::whereBetween('voucher_date',[date('Y-m-d',strtotime($request->from_date)),date('Y-m-d',strtotime($request->to_date))])->where('contact_id',$request->contact_id)->get();
            }
        }
        else
        {
            $refunds = Refund::whereBetween('voucher_date',[date('Y-m-d',strtotime($from_date)),date('Y-m-d',strtotime($to_date))])->get();
        }
        return view('reports.refund_report', compact('org', 'from_date', 'to_date',  'refunds', 'report_type','contacts'));
    }
    public function contact_report(Request $request)
    {
        $org = Organization::first(); 
        $societies=Society::get();
        $cities = Master::where('master_name','City')->get();
        $occupations = Master::where('master_name','Occupation')->get();
        $contacts = Contact::where('contact_type','<>','Member')->get();
        if($request->input())
        {
            
            $society_id = $request->society_id;
            $city = $request->city;
            $occupation = $request->occupation;
            $report_type = $request->report_type;

            if(($request->society_id == null) && ($request->city == null) && ($request->occupation == null))
            {
                
                $contacts = Contact::where('contact_type','<>','Member')->get();
            
            }
            else if(($request->city == null) && ($request->occupation == null))
            {
                $contacts = Contact::where('contact_type','<>','Member')->where('society_id',$request->society_id)->get();
            }

            else if(($request->occupation == null) && ($request->society_id == null))
            {
                $contacts = Contact::where('contact_type','<>','Member')->where('city',$request->city)->get();
            }
            else if(($request->city == null) && ($request->society_id == null))
            {
                $contacts = Contact::where('contact_type','<>','Member')->where('occupation',$request->occupation)->get();
            }
            else if($request->society_id == null) 
            {
                $contacts = Contact::where('contact_type','<>','Member')->where('occupation',$request->occupation)->where('city',$request->city)->get();
            }
            else if($request->city ==null) 
            {
                $contacts = Contact::where('contact_type','<>','Member')->where('occupation',$request->occupation)->where('society_id',$request->society_id)->get();
            }
            else if($request->occupation == null)
            {
                $contacts = Contact::where('contact_type','<>','Member')->where('society_id',$request->society_id)->where('city',$request->city)->get();
            }
            else
            {
                $contacts = Contact::where('contact_type','<>','Member')->where('society_id',$request->society_id)->where('city',$request->city)->where('occupation',$request->occupation)->get();
            }
        }
        return view('reports.contact_report', compact('societies','cities','occupations','org','report_type','contacts'));
    }
    public function member_report(Request $request)
    {
        
        $societies=Society::get();
        $contacts = Contact::where('contact_type','Member')->get();
        $org = Organization::first();
        $society_id = $request->society_id;
        $report_type = $request->report_type;
        if($request->input())
        {
            
            $society_id = $request->society_id;
            $report_type = $request->report_type;
            if(($request->contact_id == '') && ($request->society_id == ''))
            {
                $contacts = Contact::get();
            }
            else if($request->society_id == '')
            {
                $contacts = Contact::where('contact_id', $request->contact_id)->get();            
            }
            else if($request->contact_id == '')
            {
                $contacts = Contact::where('society_id', $request->society_id)->get();
            }
            else
            {
                $contacts = Contact::where('society_id',$request->society_id)->where('contact_id',$request->contact_id)->get();
            }
        }
       
        return view('reports.member_report', compact('societies','contacts','org','report_type'));
    } 
}
