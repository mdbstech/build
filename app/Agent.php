<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
     protected $fillable = [
        'agent_name','agent_code','mobile_no','phone_no','email','project_name','customers','call_logs','task','targets','sales','created_by','updated_by',
    ];
    protected $primaryKey = 'agent_id';
}
