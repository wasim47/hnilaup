<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{

	protected $fillable = ['notice_type_id','name', 'slug','details', 'image', 'meta_details','keywords','sequence', 'status'];
	
	public function getNoticeType(){
		return $this->belongsTo(NoticeType::class, 'notice_type_id','id');
	}	
	
	
}
