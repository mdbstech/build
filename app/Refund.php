<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable=['contact_id','site_allotment_id','voucher_no','voucher_date','payment_mode','date','num','amount','created_by','updated_by'];
    
    protected $primaryKey='refund_id';

    public function Contact()
 {
 	return $this->hasOne('App\Contact','contact_id','contact_id');
 }
 public function SiteAllotment()
 {
 	return $this->hasOne('App\SiteAllotment','site_allotment_id','site_allotment_id');
 }


}
