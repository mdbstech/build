<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignUser extends Model
{
  protected $fillable = [
      'user_id','contact_id','assign_date','note',
             'created_by','updated_by',
  ];
  protected $primaryKey = 'assign_id';

  public function User()
  {
     return $this->hasOne('App\User', 'user_id', 'user_id');
  }

  public function Contact()
  {
     return $this->hasOne('App\Contact', 'contact_id', 'contact_id');
  }
}
