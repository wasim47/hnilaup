<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Secretary extends Authenticatable
{
	use Notifiable;
		
	protected $fillable = ['fullname', 'email', 'contact','designation','address','password','password_hints', 'photo'];
	
	
}
