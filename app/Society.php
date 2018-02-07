<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
   protected $fillable = [
        'society_code', 'society_name', 'industry', 'address1', 'address2', 'city', 'state', 'country', 'mobile_no', 'phone_no', 'email',  'gstin_no', 'pan_no', 'cin_no', 'tin_no', 'cst_no','logo','created_by','updated_by',
    ];
    protected $primaryKey = 'society_id';
}
