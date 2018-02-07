<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
  protected $fillable = [
      'project_id','contact_id','category_id','site_no','site_dimension','site_description','color',
             'created_by','updated_by',
  ];
  protected $primaryKey = 'site_id';

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
}
