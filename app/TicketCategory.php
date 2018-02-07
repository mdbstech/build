<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    protected $fillable = [
    'category_name', 'description','ticket_category_code','color','created_by','updated_by',
];
protected $primaryKey = 'category_id';
}
