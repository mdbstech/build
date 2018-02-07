<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'voucher_no','voucher_date','expense_account','paid_through','contact_id','payment_mode','amount','file','note','created_by','updated_by',
    ];

    protected $primaryKey = 'expense_id';

    
    public function Contact()
    {
       return $this->hasOne('App\Contact', 'contact_id', 'contact_id');
    }

    public function ExpenseAccount()
    {
       return $this->hasOne('App\Account', 'account_id', 'expense_account');
    }

    public function PaidThrough()
    {
       return $this->hasOne('App\Account', 'account_id', 'paid_through');
    }
}
