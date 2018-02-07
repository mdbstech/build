<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $fillable=['site_allotment_id','installment_name','no_of_days','due_date','new_amount','created_by','updated_by'];
    protected $primaryKey = 'installment_id';
}
