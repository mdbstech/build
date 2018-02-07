<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;

use Auth;

use App\Contact;

use Excel;

use App\Master;
use App\Society;
use App\User;
use App\Payment;
use App\Refund;
use App\SiteAllotment;
use Image;
class ContactController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth');
     }

    public function create()
    {
      $id = Contact::max('contact_id');
      $contact_code = $id + 1;
      $length = strlen($contact_code);
      $n = 4 - $length;
      for ($i=0; $i < $n; $i++)
      {
          $contact_code = '0'.$contact_code;
      }
        $relationship_types = Master::where('master_name','Relationship Type')->get();
        $cities = Master::where('master_name','City')->get();
        $occupations = Master::where('master_name','Occupation')->get();
        $reference_types = Master::where('master_name','Reference Type')->get();
        $societies=Society::get();
        $users = User::get();
        $categories = Master::where('master_name','Category')->get();
        $religions = Master::where('master_name','Religion')->get();
        $caste = Master::where('master_name','Caste')->get();
        return view('contact.create',compact(
            'contact_code','relationship_types','societies','users','cities','occupations','reference_types','categories','religions','caste'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'contact_code' => 'max:50',
            'contact_name' => 'required|max:50',
            'contact_type' => 'required',
            'email' => 'max:50|email',
            'mobile_no' => 'required|min:10|max:10',
            'gender'=>'required|max:50', 
            'reference_type'=>'max:50',
            'user_id'=>'',

        ]);

        $contact = Contact::create([
            'society_id' => $request['society_id'],
            'user_id'=> $request['user_id'],
            'contact_code' => $request['contact_code'],
            'contact_name' => $request['contact_name'],
            'membership_no' => $request['membership_no'],
            'contact_type' => $request['contact_type'],
            'email' => $request['email'],
            'mobile_no' => $request['mobile_no'],
            'phone_no' => $request['phone_no'],
            'gender' => $request['gender'],
            'dob' => date('Y-m-d', strtotime($request->dob)),
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
            'created_by' => Auth::User()->username,
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

        return redirect('/contact/display')->with('success-message', 'Contact '.$contact->contact_name.' is successfully Created...!');
        
    }
    public function edit(Contact $contact)
        {
        	$contacts = Contact::paginate(10);
            $relationship_types = Master::where('master_name','Relationship Type')->get();
            $cities = Master::where('master_name','City')->get();
            $occupations = Master::where('master_name','Occupation')->get();
            $reference_types = Master::where('master_name','Reference Type')->get();
            $societies=Society::get();
            $categories = Master::where('master_name','Category')->get();
            $religions = Master::where('master_name','Religion')->get();
            $caste = Master::where('master_name','Caste')->get();
            return view('contact.edit',compact('contacts','contact','societies','relationship_types','cities','occupations','reference_types','categories','religions','caste'));
        }

        public function update(Request $request, Contact  $contact)
        {
        	$this->validate($request, [
                'contact_code' => 'max:50',
                'contact_name' => 'required|max:50',
                'email' => 'max:50|email',
                'mobile_no' => 'required|min:10|max:10',  
                'gender'=>'required|max:50', 
                'reference_type'=>'max:50',
                'user_id'=>'',
                
            ]);

            Contact::where('contact_id',$contact->contact_id)->update([
                'society_id' => $request['society_id'],
                'user_id' => $request['user_id'],
                'contact_code' => $request['contact_code'],
                'contact_name' => $request['contact_name'],
                'membership_no' => $request['membership_no'],
                'contact_type' => $request['contact_type'],
                'email' => $request['email'],
                'mobile_no' => $request['mobile_no'],
                'phone_no' => $request['phone_no'],
                'gender' => $request['gender'],
                'dob' => date('Y-m-d', strtotime($request->dob)),
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

            return redirect('/contact/display')->with('success-message', 'Contact '.$contact->contact_code.' is successfully updated...!');
        }
        public function delete(Request $request)
        {
            Contact::where('contact_id',$request->contact_id)->delete();
        }

    
    public function view(Contact $contact)
    {  
        $payments = Payment::where('contact_id', $contact->contact_id)->get();
        $site_allotments =SiteAllotment::where('contact_id', $contact->contact_id)->get();
        $refunds = Refund::where('contact_id',$contact->contact_id)->get();
        
        return view('contact.view',compact('contact','payments','site_allotments','refunds'));
    }
    public function lead(Contact $contact)
    {  
        $contacts = Contact::get(); 
        return view('contact.lead',compact('contact','contacts'));
    }

    public function display()
    {
        $contacts = Contact::paginate(10);
        return view('contact.display',compact('contacts'));
    }

    
    public function get_name(Request $request)
    {
        $user=User::where('user_role',$request->reference_type)->get();
        return response()->json($user);
    }

    public function upload()
    {
        return view('contact.upload');
    }

    public function upload_excel(Request $request)
    { 
        if(Input::hasFile('import_file')){
            
            $path = Input::file('import_file')->getRealPath();

            $data = Excel::load($path, function($reader) {

            })->get();


            if(!empty($data) && $data->count()){
                foreach($data as $value) 

                {
                    $contact_code = $value->contact_code;
                    $contact_name = $value->contact_name;
                    $contact_type = $value->contact_type;
                    $gender = $value->gender;
                    $email = $value->email;
                    $mobile_no = $value->mobile_no;
                    $reference_type = $value->reference_type;
                    $reference_name = $value->reference_name;
                    $relationship_type = $value->relationship_type;
                    $relationship_name = $value->relationship_name;
                    $dob = $value->dob;
                    $marital_status = $value->marital_status;
                    $phone_no = $value->phone_no;
                    $society = $value->society;
                    $address1 = $value->address1;
                    $address2 = $value->address2;
                    $city = $value->city;
                    $state = $value->state;
                    $pincode = $value->pincode;
                    $country = $value->country;
                    $occupation = $value->occupation;
                    $annual_income = $value->annual_income;
                    $nationality = $value->nationality;
                    $religion = $value->religion;
                    $caste = $value->caste;
                    $category = $value->category;
                    $nominee = $value->nominee;
                    $nominee_relationship = $value->nominee_relationship;
                    $nominee_age = $value->nominee_age;
                    $site_dimension = $value->site_dimension;
                    $count = Contact::where('email',$email)->where('dob',$contact_name)->where('mobile_no',$mobile_no)->count();
                    $society_count = Society::where('society_name',$society)->count(); 
                    $user_count = User::where('username',$reference_name)->count();
                    if($user_count == 1)
                    {
                        $reference_name = User::where('username',$reference_name)->first();
                        $user_id = $reference_name->user_id;

                    }
                    else
                    {

                        $user_id = 1;
                    }
                    if($society_count == 1)
                    {
                        $society = Society::where('society_name',$society)->first();
                        $society_id = $society->society_id;
                    }
                    else
                    {
                        $society_id = 1;
                    }

                    if($count==0)
                    {  
                        $contact = Contact::create([
                            'contact_code' => $contact_code,
                            'contact_name' => $contact_name,
                            'contact_type' => $contact_type,
                            'gender' => $gender,
                            'email' => $email,
                            'mobile_no' => $mobile_no,
                            'reference_type' => $reference_type,
                            'user_id' => $user_id,
                            'relationship_type' => $relationship_type,
                            'relationship_name' => $relationship_name,
                            'dob' => $dob,
                            'marital_status' => $marital_status,
                            'phone_no' => $phone_no,
                            'society_id' => $society_id,
                            'address1' => $address1,
                            'address2' => $address2,
                            'city' => $city,
                            'state' => $state,
                            'pincode' => $pincode,
                            'country' => $country,
                            'occupation' => $occupation,
                            'annual_income' => $annual_income,
                            'nationality' => $nationality,
                            'caste' => $caste,
                            'category' => $category,
                            'nominee' => $nominee,
                            'nominee_relationship' => $nominee_relationship,
                            'nominee_age' => $nominee_age,
                            'site_dimension' => $site_dimension,
                            'created_by' => Auth::User()->username,
                        ]);
                    }
                }
                return view('contact.upload');
            }
        }
    }
    public function save_contact(Request $request,Contact $contact)
    {

        $this->validate($request, [
            'membership_no' => 'required|max:50',
            'contact_type' => 'required',
        ]);

        Contact::where('contact_id',$contact->contact_id)->update([
            'membership_no' => $request['membership_no'],
            'contact_type' => $request['contact_type'],
            'contact_name' => $request['contact_name'],
            'email' => $request['email'],   
            'mobile_no' => $request['mobile_no'],
            'gender' => $request['gender'],
            'updated_by' => Auth::User()->username,

        ]);
        return redirect('/contact/display')->with('success-message', 'Contact '.$contact->membership_no.' is successfully promoted...!');
    }
    public function search(Request $request)
    {
        $data = explode(',',$request->field);
        $relationship_types = Master::where('master_name','Relationship Type')->get();
        $cities = Master::where('master_name','City')->get();
        $occupations = Master::where('master_name','Occupation')->get();
        $reference_types = Master::where('master_name','Reference Type')->get();
        $societies=Society::get();
        $users = User::get();
        $categories = Master::where('master_name','Category')->get();
        $religions = Master::where('master_name','Religion')->get();
        $caste = Master::where('master_name','Caste')->get();
            $this->validate($request, [
                'search' => 'required'
            ]);
            
                if($data[1]=='f')
                {   
                    
                    $contacts = Contact::where($data[0],'LIKE',"%$request->search%")
                        ->paginate(10)
                        ->appends(['field' => $request->field])
                        ->appends(['search' => $request->search]);
                        ;
                        
                }
                else
                {
                    $contacts = Contact::whereHas($data[2], function($query) use($request,$data){
                        $query->where($data[0],'LIKE',"%$request->search%");
                    })
                        ->paginate(10)
                        ->appends(['field' => $request->field])
                        ->appends(['search' => $request->search]);
                        
                        
                }
                return view('contact.display',compact('relationship_types','cities','occupations','reference_types','societies','users','categories','religions','caste','contacts'));
            }
           
       
       
        
    

}
 