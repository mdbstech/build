<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
  protected $fillable = [
    'priority_name', 'description','priority_code','color',
           'created_by','updated_by',
];
protected $primaryKey = 'priority_id';
}
