<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{

	protected $fillable = ['user_id', 'sender_name','receiver_name','receiver_contact','purpose', 'amount','date','remark'];	
}
