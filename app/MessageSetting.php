<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageSetting extends Model
{
    protected $fillable = ['url','auth_key','promotional_route','transactional_route','promotional_sender','transactional_sender','country','created_by','updated_by',];

    protected $primaryKey = 'message_setting_id';
}
