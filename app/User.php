<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'name', 'email', 'mobile_no', 'phone_no', 'password', 'user_role', 'address1', 'address2', 'city','state', 'country', 'zipcode', 'avatar','created_by', 'updated_by',

    ];

    protected $primaryKey = 'user_id';

    protected $hidden = [
        'password', 'remember_token',
    ];

  public function Contact()
  {
     return $this->hasOne('App\Contact', 'contact_id', 'contact_id');
  }

  public function FollowUp()
  {
     return $this->hasOne('App\FollowUp', 'follow_id', 'follow_id');
  }

  /*public function User()
  {
     return $this->hasOne('App\AssignUser', 'user_id', 'user_id');
  }*/
}
