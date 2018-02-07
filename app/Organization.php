<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'org_code', 'org_name', 'industry', 'address1', 'address2', 'city', 'state', 'country', 'mobile_no', 'phone_no', 'email', 'fiscal_year', 'gstin_no', 'pan_no', 'cin_no', 'tin_no', 'cst_no', 'state_code', 'logo','created_by','updated_by',
    ];
    protected $primaryKey = 'org_id';
}
