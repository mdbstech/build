<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteAllotment extends Model
{
    protected $fillable = [
      'project_id','contact_id','category_id','site_id','dimension','amount', 'status','reference_date','reference_no',
             'created_by','updated_by',
  ];
  protected $primaryKey = 'site_allotment_id';

  public function Project()
  {
     return $this->hasOne('App\Project', 'project_id', 'project_id');
  }
  

  public function Contact()
  {
     return $this->hasOne('App\Contact', 'contact_id', 'contact_id');
  }
  public function Category()
  {
     return $this->hasOne('App\Category', 'category_id', 'category_id');
  }
  public function Site()
  {
     return $this->hasOne('App\Site', 'site_id', 'site_id');
  }
  public function Installment()
  {
    return $this->hasOne('App\Installment', 'installment_id', 'installment_id');
  }

  public function PaymentAmount($site_allotment_id)
  {
    return Payment::where('site_allotment_id', $site_allotment_id)->sum('amount');
  }

  public function PaymentDueAmount($site_allotment_id)
  {
    $amount = SiteAllotment::where('site_allotment_id', $site_allotment_id)->first()->amount;
    $payment_amount = Payment::where('site_allotment_id', $site_allotment_id)->sum('amount');
    $due = $amount - $payment_amount;
    if($due > 0)
    {
      return $due;
    }
    else
    {
      return 0;
    }
  }

  public function RefundAmount($site_allotment_id)
  {
    
    return Refund::where('site_allotment_id', $site_allotment_id)->sum('amount');
  }
}
