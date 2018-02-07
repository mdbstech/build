<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calllog extends Model
{
    protected $fillable = [
        'contact_id', 'user_id', 'note', 'call_log', 'followup_date', 'reference_type','status','created_by', 'updated_by'

    ];

    protected $primaryKey = 'calllog_id';

    public function Contact()
    {
    	return $this->hasOne('App\Contact','contact_id','contact_id');
    }

    public function Agent()
    {
    	return $this->hasOne('App\User','user_id','user_id');
    }
}

