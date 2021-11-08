<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticeType extends Model
{
	protected $fillable = ['name', 'slug'];
	
	public function items() {
        return $this->hasMany(Notice::class)->limit(20);
    }
	
}
