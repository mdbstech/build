<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SiteAllotment;
use App\Payment;

class Contact extends Model
{
    protected $fillable = [
        'contact_name','user_id','membership_no','contact_type','society_id','contact_code','email','dob','gender','relationship_type','relationship_name','nationality','religion','caste','category','annual_income','nominee','nominee_relationship','nominee_age','reference_type','site_no','site_dimension','image','mobile_no','phone_no','address1','address2','city','occupation','state','pincode','country',
               'created_by','updated_by',
    ];
    protected $primaryKey = 'contact_id';

    public function Society()
    {
    	
    	return $this->hasOne('App\Society','society_id','society_id');
    }
    
    public function User()
    {
        
        return $this->hasOne('App\User','user_id','user_id');
    }

    public function SiteAllotments($contact_id)
    {
        return SiteAllotment::where('contact_id', $contact_id)->get();
    }

    public function SiteAllotmentAmount($contact_id)
    {
        $site_allotment = SiteAllotment::where('contact_id', $contact_id)->where('status', 'open')->first();
        if($site_allotment == '')
        {
           return 0;
        }
        else
        {
        return $site_allotment->amount;
    }
    }

    public function PaymentAmount($contact_id)
    {
        $site_allotment = SiteAllotment::where('contact_id', $contact_id)->where('status', 'open')->first();
        if($site_allotment == '')
        {
           return 0;
        }
        else
        {
           return Payment::where('site_allotment_id', $site_allotment->site_allotment_id)->sum('amount');
        }
        
    }


}
