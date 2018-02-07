<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
  protected $fillable = [
      'tax_name', 'tax_rate', 'sgst_name', 'sgst_rate', 'cgst_name', 'cgst_rate', 'igst_name','igst_rate',
             'created_by','updated_by',
  ];
  protected $primaryKey = 'tax_id';
}
