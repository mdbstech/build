<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;

use App\Member;

use App\User;

use App\Contact;

use App\Master;
use App\Payment;
use App\Site;
use App\Category;
use App\Project;
use App\Society;
use App\SiteAllotment;
use App\Refund;


class MemberController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function display()
  {
      $members = Contact::where('contact_type','Member')->paginate(10);
      return view('member.display',compact('members'));
  }
  
  public function edit(Contact $contact)
  {
    $contacts = Contact::where('contact_type','Member')->paginate(10);
    $relationship_types = Master::where('master_name','Relationship Type')->get();
    $cities = Master::where('master_name','City')->get();
    $occupations = Master::where('master_name','Occupation')->get();
    $reference_types = Master::where('master_name','Reference Type')->get();
    $societies = Society::get();
    $categories = Master::where('master_name','Category')->get();
    $religions = Master::where('master_name','Religion')->get();
    $caste = Master::where('master_name','Caste')->get();
    return view('member.edit',compact('contacts','contact','relationship_types','societies','cities','reference_types','occupations','religions','categories','caste'));
  }
      public function update(Request $request, Contact $contact)
     {
         $this->validate($request, [
           
            'contact_name' => 'required|max:50',
            'contact_type' => 'required',
            'email' => 'max:50|email',
            'mobile_no' => 'required|max:10',
            'gender'=>'required|max:50',
            'reference_type' => 'max:50',
            'user_id'=> '',

          ]);

         Contact::where('contact_id', $contact->contact_id)->update([
          
            'membership_no' => $request['membership_no'],
            'user_id' => $request['user_id'],
            'society_id' => $request['society_id'],
            'contact_code' => $request['contact_code'],
            'contact_name' => $request['contact_name'],
            'contact_type' => $request['contact_type'],
            'email' => $request['email'],
            'mobile_no' => $request['mobile_no'],
            'phone_no' => $request['phone_no'],
            'gender' => $request['gender'],
            'dob' => $request['dob'],
            'relationship_type' => $request['relationship_type'],
            'relationship_name' => $request['relationship_name'],
            'marital_status' => $request['marital_status'],
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'city' => $request['city'],
            'state' => $request['state'],
            'pincode' => $request['pincode'],
            'country' => $request['country'],
            'nationality' => $request['nationality'],
            'religion' => $request['religion'],
            'caste' => $request['caste'],
            'category' => $request['category'],
            'occupation' => $request['occupation'],
            'annual_income' => $request['annual_income'],
            'nominee'=>$request['nominee'],
            'nominee_relationship' => $request['nominee_relationship'],
            'nominee_age' => $request['nominee_age'],
            'site_dimension' => $request['site_dimension'],
            'reference_type' => $request['reference_type'],
           'updated_by' => Auth::User()->username,
         ]);

         if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filename ='Contact-'. $contact->contact_id . '.' . $file->getClientOriginalExtension();
            Image::make($file)->save(public_path('/images/user/'.$filename));
            Contact::where('contact_id', $contact->contact_id)->update([
                'image' => $filename,
            ]);
         }
         $contact = Contact::where('contact_id', $contact->contact_id)->first();
         return redirect('/member/display/')->with('success-message', 'Member '.$contact->membership_no.' is successfully updated...!');
     }
     public function delete(Request $request)
     {
         Member::where('member_id',$request->member_id)->delete();
     }

     public function search(Request $request)
    {
     $this->validate($request, [
         'search' => 'required'
     ]);

    
     $members = Contact::
        where([['contact_type','=','Member'], ['contact_name','like', "%$request->search%"]])
         /*->orWhereHas('User', function($query) use($request){
             $query->where('user_id','like','%'.$request->search.'%');
         })*/
         
        ->orWhere([['contact_type','=','Member'], ['membership_no','like', "%$request->search%"]])
        ->orWhere([['contact_type','=','Member'], ['mobile_no','like', "%$request->search%"]])
        ->orWhere([['contact_type','=','Member'], ['phone_no','like', "%$request->search%"]])
        ->orWhere([['contact_type','=','Member'], ['email','like', "%$request->search%"]])
        ->orWhere([['contact_type','=','Member'], ['gender','like', "%$request->search%"]])
         ->paginate(10)
         ->appends(['search' => $request->search]);
     return view('member.display',compact('members'));
    }

    public function view(Contact $contact)
   {
        $payments = Payment::where('contact_id', $contact->contact_id)->get();
        $site_allotments =SiteAllotment::where('contact_id', $contact->contact_id)->get();
        $refunds = Refund::where('contact_id',$contact->contact_id)->get();
        
        return view('member.view',compact('contact','payments','site_allotments','refunds'));
    }

    public function new_member_report(Request $request)
    {
        $this->validate($request, [
            'contact_id' => 'max:50',
            'report_format' => 'required',
        ]);

        $org = Organization::first();
        $contacts = Contact::where('contact_type','Member')->get();
        $societies = Society::get();
        $society_id = $request->society_id;
        $report_format = $request->report_format;
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

        return view('member.new_member_report', compact('org', 'contacts', 'report_format','society_id','societies','contacts'));
    }

     
}
