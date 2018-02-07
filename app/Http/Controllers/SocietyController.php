<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Society;

class SocietyController extends Controller
{
      public function __construct()
     {
         $this->middleware('auth');
     }
     
    public function create()
    {
        $id = Society::count();
        $society_code = $id + 1;
        $length = strlen($society_code);
        $n = 4 - $length;
        for ($i=0; $i < $n; $i++) 
        { 
            $society_code = '0'.$society_code;
        }
    	$societies=Society::paginate(10);
    	return view('society.create',compact('societies','society_code'));
    }
    public function store(Request $request)
    {
    	 $this->validate($request, [
            'society_code' => 'required|max:50',
            'society_name' => 'required|max:50',
            'industry' => 'max:50',
            'address1' => 'required|max:255',
            'address2' => 'max:255',
            'city'=>'required|max:50',
            'state'=>'required|max:50',
            'country'=>'required|max:50',
            'phone_no' => 'max:10',
            'mobile_no' => 'required|min:10|max:10',
            'email'=>'max:50|email',
           
            'gstin_no' => 'max:50',
            'pan_no' => 'max:50',
            'cin_no' => 'max:50',
            'tin_no' => 'max:50',
            'cst_no' => 'max:50',
          
        ]);

        $society =Society::create([
            'society_code' => $request['society_code'],
            'society_name' => $request['society_name'],
            'industry' => $request['industry'],
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'city' => $request['city'],
            'state' => $request['state'],
            'country' => $request['country'],
            'phone_no' => $request['phone_no'],
            'mobile_no' => $request['mobile_no'],
            'email' => $request['email'],
          
            'gstin_no' => $request['gstin_no'],
            'pan_no' => $request['pan_no'],
            'cin_no' => $request['cin_no'],
            'tin_no' => $request['tin_no'],
            'cst_no' => $request['cst_no'],
           
            'logo' => $request['logo'],
            'created_by' => Auth::User()->username,
        ]);
        if($request->hasFile('logo'))
        {
            $file = $request->file('logo');
            $filename ='Logo-'. $society->society_id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('society',$filename);

            Society::where('society_id',$society->society_id)->update([
                'logo' => $filename,
            ]);
        }
      

        return redirect('/society/display/')->with('success-message', 'Society '.$society->society_name.' is successfully Created...!');
    }


    


    public function edit(Society $society)
        {
        	$societies = Society::paginate(10);
            
            return view('society.edit',compact('societies','society'));
        }
        public function update(Request $request, Society $society)
    {
        $this->validate($request, [
            'society_code' => 'required|max:50',
            'society_name' => 'required|max:50',
            'industry' => 'max:50',
            'address1' => 'required|max:50',
            'address2' => 'max:50',
            'city'=>'required|max:50',
            'state'=>'required|max:50',
            'country'=>'required|max:50',
            'phone_no' => 'max:20',
            'mobile_no' =>  'required|min:10|max:10',
            'email'=>'max:50|email',
           
            'gstin_no' => 'max:50',
            'pan_no' => 'max:50',
            'cin_no' => 'max:50',
            'tin_no' => 'max:50',
            'cst_no' => 'max:50',
           

        ]);
        Society::where('society_id',$society->society_id)->update([
            'society_code' => $request['society_code'],
            'society_name' => $request['society_name'],
            'industry' => $request['industry'],
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'city' => $request['city'],
            'state' => $request['state'],
            'country' => $request['country'],
            'phone_no' => $request['phone_no'],
            'mobile_no' => $request['mobile_no'],
            'email' => $request['email'],
           
            'gstin_no' => $request['gstin_no'],
            'pan_no' => $request['pan_no'],
            'cin_no' => $request['cin_no'],
            'tin_no' => $request['tin_no'],
            'cst_no' => $request['cst_no'],
         
            'logo' => $request['logo'],
            'updated_by' => Auth::User()->username,
        ]);

        if($request->hasFile('logo'))
        {
            $file = $request->file('logo');
            $filename ='Logo-'. $society->society_id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('society',$filename);

            Society::where('society_id',$society->society_id)->update([
                'logo' => $filename,
            ]);
        }
        return redirect('/society/display')->with('success-message', 'Society '.$society->society_name.' is successfully updated...!');
        
}

        public function delete(Request $request)
        {
            Society::where('society_id',$request->society_id)->delete();
        }

 public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required'
        ]);
       

        $societies = Society::
            where('society_name', 'like', "%$request->search%")
            ->orWhere('society_code', 'like', "%$request->search%")
            ->orWhere('email', 'like', "%$request->search%")
            ->orWhere('mobile_no', 'like', "%$request->search%")
            ->orWhere('phone_no', 'like', "%$request->search%")
            ->orWhere('address1', 'like', "%$request->search%")
            ->orWhere('address2', 'like', "%$request->search%")
            ->orWhere('city', 'like', "%$request->search%")
            ->orWhere('state', 'like', "%$request->search%")
            ->orWhere('country', 'like', "%$request->search%")
            ->paginate(10)
            ->appends(['search' => $request->search]);


        return view('society.display',compact('societies','society_code'));
    }
    public function view(Society $society)
    {
        return view('society.view',compact('society'));
    }


         public function display()
    {
        $societies = Society::paginate(10);
        return view('society.display',compact('societies'));
    }
}
