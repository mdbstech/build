<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'receipt_no','receipt_date','income_account','deposit_to','contact_id','payment_mode','amount','file','note','created_by','updated_by',
    ];

    protected $primaryKey = 'income_id';

    public function Contact()
    {
       return $this->hasOne('App\Contact', 'contact_id', 'contact_id');
    }

    public function IncomeAccount()
    {
       return $this->hasOne('App\Account', 'account_id', 'income_account');
    }

    public function DepositTo()
    {
       return $this->hasOne('App\Account', 'account_id', 'deposit_to');
    }
}
