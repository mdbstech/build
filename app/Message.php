<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
      protected $fillable = [
        'ticket_id','message','message_type','created_by','updated_by',
    ];
    protected $primaryKey = 'message_id';
}
