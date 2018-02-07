<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignSite extends Model
{
  protected $fillable = [
      'assign_date','reference_no','contact_id','project_id','site_id',
             'created_by','updated_by',
  ];
  protected $primaryKey = 'assign_site_id';

  public function Contact()
  {
     return $this->hasOne('App\Contact', 'contact_id', 'contact_id');
  }

  public function Project()
  {
     return $this->hasOne('App\Project', 'project_id', 'project_id');
  }

  public function Site()
  {
     return $this->hasOne('App\Site', 'site_id', 'site_id');
  }

}
