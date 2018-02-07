<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    protected $fillable = [
        'master_name','master_value','created_by','updated_by',
    ];
    protected $primaryKey = 'master_id';
}
