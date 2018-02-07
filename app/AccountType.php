<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
     protected $fillable = [
        'account_type','account_type_description','created_by','updated_by',
    ];
    protected $primaryKey = 'account_type_id';
}
