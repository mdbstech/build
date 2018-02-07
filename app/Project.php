<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_code','project_name','project_location','address1','address2','city','state','country','no_of_sites','project_image','created_by','updated_by',
    ];
    protected $primaryKey = 'project_id';

    
}
