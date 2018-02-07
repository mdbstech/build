<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
    'ticket_no', 'ticket_date','category_id','priority_id','contact_id','user_id','status','note','checked','read_status',
           'created_by','updated_by',
	];
	protected $primaryKey = 'ticket_id';

	public function Category()
	{
	   return $this->hasOne('App\TicketCategory', 'category_id', 'category_id');
	}

	public function Priority()
	{
	   return $this->hasOne('App\Priority', 'priority_id', 'priority_id');
	}

	public function Contact()
	{
	   return $this->hasOne('App\Contact', 'contact_id', 'contact_id');
	}
	public function User()
	{
	   return $this->hasOne('App\User', 'user_id', 'user_id');
	}
	public function Message()
	{
	    return $this->hasMany('App\Message','ticket_id','ticket_id');
	}
	public function DefaultMessage($ticket_id)
	{
		return Message::where([['ticket_id',$ticket_id],['message_type','Default']])->first();
	}
	
	
}
