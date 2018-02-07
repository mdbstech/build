<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['ticket_id','file','created_by','updated_by',];

    protected $primaryKey = 'file_id';


}
