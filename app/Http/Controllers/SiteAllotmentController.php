<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\SiteAllotment;
use App\Installment;

use App\Contact;

use App\Project;

use App\Category;

use App\Site;

use App\Payment;


class SiteAllotmentController extends Controller
{
    public function __construct()
    { 
        $this->middleware('auth');
    }
    public function create(Contact $contact)
    {
        $id = SiteAllotment::max('site_allotment_id');
        $reference_no = $id + 1;
        $length = strlen($reference_no);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++)
        {
            $reference_no = '0'.$reference_no;
        }
        $projects = Project::get();
        $contacts = Contact::where('contact_type','Member')->get();
        $categories = Category::get();
        $installment = Installment::whereNull('site_allotment_id')->where('created_by',Auth::User()->name)->get();
        $site_allotment= SiteAllotment::get();
        return view('site_allotment.create',compact('categories','projects','contacts','contact','installment','site_allotment','reference_no'));
        
    }
    public function store(Request $request)
    {
      
        $this->validate($request, [
            'contact_id' => 'required|numeric',
            'project_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'dimension' => 'required|max:50',
            'reference_date' => 'required',
            'reference_no' =>'required|max:50',
      
        ]);
    
        $site_allotment = SiteAllotment::create([
            'contact_id' => $request['contact_id'],
            'project_id' => $request['project_id'],
            'category_id' => $request['category_id'],
            'site_id' => $request['site_id'],  
            'reference_date' =>  date('Y-m-d',strtotime($request['reference_date'])),
            'reference_no' => $request['reference_no'],          
            'dimension' => $request['dimension'],
            'amount' => $request['amount'],
            'created_by' => Auth::User()->username,
        ]);
        Installment::whereNull('site_allotment_id')->where('created_by', Auth::User()->name)->update([
                'site_allotment_id' => $site_allotment->site_allotment_id,
            ]);

        return redirect('/contact/view/'.$site_allotment->contact_id)->with('success-message', 'SiteAllotment '.$site_allotment->amount.' is successfully Created...!');
    }

    public function edit(SiteAllotment $site_allotment)
    {
        $projects = Project::get();
        $contacts = Contact::where('contact_type','Member')->get();
        $categories = Category::get();
        $installment = Installment::whereNull('site_allotment_id')->orWhere('site_allotment_id', $site_allotment->site_allotment_id)->where('created_by',Auth::User()->name)->get();
        $site_allotment= SiteAllotment::where('site_allotment_id', $site_allotment->site_allotment_id)->first();
        return view('site_allotment.edit',compact('projects','categories','contacts','site_allotment','installment','contact'));
    }

    public function update(Request $request, SiteAllotment  $site_allotment)
    {
        $this->validate($request, [
            'contact_id' => 'required|numeric',
            'project_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'dimension' => 'required|max:50',
            'reference_date' =>'required',
            'reference_no' =>'required|max:50',
        ]);

        SiteAllotment::where('site_allotment_id',$site_allotment->site_allotment_id)->update([
            'contact_id' => $request['contact_id'],
            'project_id' => $request['project_id'],
            'category_id' => $request['category_id'],
            'dimension' => $request['dimension'],
            'reference_date' => date('Y-m-d',strtotime($request['reference_date'])),
            'reference_no' => $request['reference_no'],         
            'amount' => $request['amount'],
            'updated_by' => Auth::User()->username,

        ]);
         Installment::whereNull('site_allotment_id')->where('created_by', Auth::User()->name)->update([
                'site_allotment_id' => $site_allotment->site_allotment_id,
            ]);

        return redirect('/contact/view/'.$site_allotment->contact_id)->with('success-message', 'SiteAllotment '.$site_allotment->amount.' is successfully Created...!');
    }

    public function delete(Request $request)
    {
        SiteAllotment::where('site_allotment_id',$request->site_allotment_id)->delete();
    }

    public function search(Request $request,Contact $contact)
    {
       $this->validate($request, [
           'search' => 'required'
       ]);
        $id =SiteAllotment::max('site_allotment_id');
        $reference_no = $id + 1;
        $length = strlen($reference_no);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++)
        {
            $reference_no = '0'.$reference_no;
        }

        $projects = Project::get();
        $categories = Category::get();
        $contacts = Contact::where('contact_type','Member')->get();
        $site_allotments =  SiteAllotment::
            where('dimension', 'like', "%$request->search%")
           ->orWhereHas('Project', function($query) use($request){
               $query->where('project_name','like','%'.$request->search.'%');
           })
           ->orWhereHas('Category', function($query) use($request){
               $query->where('category_name','like','%'.$request->search.'%');
           })
           ->orWhereHas('Contact', function($query) use($request){
               $query->where('contact_name','like','%'.$request->search.'%');
           })
           ->orWhere('amount', 'like', "%$request->search%")
           ->paginate(10)
           ->appends(['search' => $request->search]);
        return view('site_allotment.display',compact('site_allotments','projects','categories','contacts','reference_no','contact'));
    }
     public function display()
  {
      $site_allotments = SiteAllotment::paginate(10);
      return view('site_allotment.display',compact('site_allotments'));
  }

    public function edit_allotment(SiteAllotment $site_allotment)
    {
        $projects = Project::get();
        $contact = Contact::where('contact_id', $site_allotment->contact_id)->first();
        $categories = Category::get();
        $site_allotments = SiteAllotment::where('project_id', $site_allotment->project_id)->get();
        $project_sites = Site::where('project_id', $site_allotment->project_id)->get();
        $site = Site::where('site_id', $site_allotment->site_id)->first();
        $selected_sites = array();

        $sites = array();
        foreach($project_sites as $project_site)
        {
            $count = 0;
            foreach($site_allotments as $site_alt)
            {
                if($project_site->site_id == $site_alt->site_id)
                {
                  $count += 1;
                }
            }
            if($count == 0)
            {
                array_push($sites, $project_site);
            }
        }

        foreach($sites as $st)
        {
            array_push($selected_sites, $st);
        }
        
        array_push($selected_sites, $site);

        return view('site_allotment.allotment',compact('projects','categories','contact','site_allotment','sites', 'selected_sites'));
    }
    public function update_allotment(Request $request, SiteAllotment  $site_allotment)
    {
        $this->validate($request, [
            'site_id' => 'required',
        ]);

        SiteAllotment::where('site_allotment_id',$site_allotment->site_allotment_id)->update([
            'site_id' => $request['site_id'],
            'updated_by' => Auth::User()->username,
        ]);

        return redirect('/contact/view/'.$site_allotment->contact_id)->with('success-message', 'SiteAllotment '.$site_allotment->amount.' is successfully Updated...!');
    }
    public function get_site(Request $request)
    {
        $site=Site::where('project_id',$request->project_id)->get();
        return response()->json($site);
    }

    public function AddRow(Request $request)
    {

        $this->validate($request,[
        'installment_name'=>'required|max:50',
        'no_of_days'=>'required',
        'due_date'=>'required',
        'new_amount'=>'required|numeric']);

        $installment=Installment::create([
            'installment_name'=>$request->installment_name,
            'no_of_days'=>$request->no_of_days,
            'new_amount'=>$request->new_amount,
            'due_date'=>date('Y-m-d',strtotime($request->due_date)),
            'created_by' => Auth::User()->name, 
        
        ]);
        return response()->json($installment);
    }
    public function EditRow(Request $request)
    {
         $installment = Installment::where('installment_id',$request->installment_id)->first();
        return response()->json($installment);
    }
     public function UpdateRow(Request $request)
    {
    $this->validate($request,[
        'installment_name'=>'required|max:50',
        'no_of_days'=>'required',
        'due_date'=>'required',
        'new_amount'=>'required|numeric']);

        Installment::where('installment_id',$request->installment_id)->update([
            'installment_name'=>$request->installment_name,
            'no_of_days'=>$request->no_of_days,
            'new_amount'=>$request->new_amount,
            'due_date'=>date('Y-m-d',strtotime($request->due_date)),
            'updated_by' => Auth::User()->name, 
        
        ]);
        $installment = Installment::where('installment_id',$request->installment_id)->first();
        return response()->json($installment); 
    }
    public function DeleteRow(Request $request)
    {
        $installment = Installment::where('installment_id',$request->installment_id)->first();
        Installment::where('installment_id',$request->installment_id)->delete();
        return response()->json($installment);
    }
    public function get_date(Request $request)
    {
        return date('d-m-Y', strtotime('+'.$request->no_of_days.' day', strtotime($request->reference_date)));
    }
    public function sum_total(Request $request)
    {
        $total_amount = Installment::whereNull('site_allotment_id')->where('created_by',Auth::User()->name)->sum('new_amount');
        return response()->json($total_amount);
    }
    public function edit_sum_total(Request $request)
    {
        $edit_total_amount = Installment::where('site_allotment_id',$request->site_allotment_id)->sum('new_amount');
        return response()->json($edit_total_amount);
    }
}
