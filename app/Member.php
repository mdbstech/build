<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'member_name','user_id','membership_no','mobile_no','phone_no','email','gender','dob','relationship_type','relationship_name','marital_status','address1','address2',
        'city','pincode','state','country','nationality','religion','caste','category','occupation','annual_income','nominee','nominee_relationship','nominee_age','site_no','site_dimension','reference','image','created_by','updated_by',
    ];
    protected $primaryKey = 'member_id';

    public function User()
    {
       return $this->hasOne('App\User', 'user_id', 'user_id');
    }
    
     public function Project()
  {
     return $this->hasOne('App\Project', 'project_id', 'project_id');
  }
  public function Category()
  {
    
    return $this->hasOne('App\Category','category_id','category_id');
  }

}
