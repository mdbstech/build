<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTerm extends Model
{
  protected $fillable = [
    'payment_term', 'no_of_days',
           'created_by','updated_by',
];
protected $primaryKey = 'payment_term_id';
}
