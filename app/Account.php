<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
     protected $fillable = [
        'account_type_id', 'account_code','account_name','account_no','bank_name','branch_name','ifsc_code','account_description','account_status','created_by', 'updated_by',
    ];

    protected $primaryKey = 'account_id';

    public function AccountType()
    {
       return $this->hasOne('App\AccountType', 'account_type_id', 'account_type_id');
    }
}
