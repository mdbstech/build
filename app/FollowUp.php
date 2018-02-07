<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
  protected $fillable = [
      'contact_id','date','time','follow_up_description','note',
             'created_by','updated_by',
  ];
  protected $primaryKey = 'follow_id';

  public function Contact()
  {
     return $this->hasOne('App\Contact', 'contact_id', 'contact_id');
  }
}
