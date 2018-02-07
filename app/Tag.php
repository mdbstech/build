<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
      'tag_name', 'tag_color',
             'created_by','updated_by',
  ];
  protected $primaryKey = 'tag_id';
}
