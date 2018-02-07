<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected $fillable = [
        'category_name','color','description',
               'created_by','updated_by',
    ];
    protected $primaryKey = 'category_id';
}
