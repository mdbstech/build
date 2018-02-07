<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Organization;


class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
   
        $count = Organization::count();
        if($count==1)
        {
            $organization = Organization::first();
            return view('organization.edit',compact('organization'));
        }
        else
        {
            return view('organization.create',compact('organization'));
        } 
    }
     public function store(Request $request)
    {
        $this->validate($request, [
            'org_code' => 'required|max:50',
            'org_name' => 'required|max:50',
            'industry' => 'required|max:50',
            'address1' => 'required|max:50',
            'address2' => 'max:50',
            'city'=>'required|max:50',
            'state'=>'required|max:50',
            'country'=>'required|max:50',
            'phone_no' => 'max:12',
            'mobile_no' => 'required|min:10|max:10',
            'email'=>'max:50|email',
            'fiscal_year' => 'required|max:50',
            'gstin_no' => 'max:50',
            'pan_no' => 'max:50',
            'cin_no' => 'max:50',
            'tin_no' => 'max:50',
            'cst_no' => 'max:50',
            'state_code' => 'required|max:50',
        ]);

        $organization =Organization::create([
            'org_code' => $request['org_code'],
            'org_name' => $request['org_name'],
            'industry' => $request['industry'],
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'city' => $request['city'],
            'state' => $request['state'],
            'country' => $request['country'],
            'phone_no' => $request['phone_no'],
            'mobile_no' => $request['mobile_no'],
            'email' => $request['email'],
            'fiscal_year' => $request['fiscal_year'],
            'gstin_no' => $request['gstin_no'],
            'pan_no' => $request['pan_no'],
            'cin_no' => $request['cin_no'],
            'tin_no' => $request['tin_no'],
            'cst_no' => $request['cst_no'],
            'state_code' => $request['state_code'],
            'created_by' => Auth::User()->username,         
        ]);
        if($request->hasFile('logo'))
        {
            $file = $request->file('logo');
            $filename ='Logo-'. $organization->org_id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('organization',$filename);

            Organization::where('org_id',$organization->org_id)->update([
                'logo' => $filename,
            ]);
        }
         return redirect('/organization/create');
    }
    public function update(Request $request, Organization $organization)
    {
        $this->validate($request, [
            'org_code' => 'required|max:50',
            'org_name' => 'required|max:50',
            'industry' => 'required|max:50',
            'address1' => 'required|max:50',
            'address2' => 'max:50',
            'city'=>'required|max:50',
            'state'=>'required|max:50',
            'country'=>'required|max:50',
            'phone_no' => 'max:12',
            'mobile_no' => 'required|min:10|max:10',
            'email'=>'max:50|email',
            'fiscal_year' => 'required|max:50',
            'gstin_no' => 'max:50',
            'pan_no' => 'max:50',
            'cin_no' => 'max:50',
            'tin_no' => 'max:50',
            'cst_no' => 'max:50',
            'state_code' => 'required|max:50',

        ]);
        Organization::where('org_id',1)->update([
            'org_code' => $request['org_code'],
            'org_name' => $request['org_name'],
            'industry' => $request['industry'],
            'address1' => $request['address1'],
            'address2' => $request['address2'],
            'city' => $request['city'],
            'state' => $request['state'],
            'country' => $request['country'],
            'phone_no' => $request['phone_no'],
            'mobile_no' => $request['mobile_no'],
            'email' => $request['email'],
            'fiscal_year' => $request['fiscal_year'],
            'gstin_no' => $request['gstin_no'],
            'pan_no' => $request['pan_no'],
            'cin_no' => $request['cin_no'],
            'tin_no' => $request['tin_no'],
            'cst_no' => $request['cst_no'],
            'state_code' => $request['state_code'],
            'updated_by' => Auth::User()->username,
        ]);
        if($request->hasFile('logo'))
        {
            $file = $request->file('logo');
            $filename ='Logo-'. $organization->org_id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('organization',$filename);

            Organization::where('org_id',$organization->org_id)->update([
                'logo' => $filename,
            ]);
        }
       return redirect('/organization/create');
    }
}
