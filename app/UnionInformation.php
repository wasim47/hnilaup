<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnionInformation extends Model
{

	protected $fillable = ['name','usefulllink_id','secretary_id','spouse_name','holding_no','wordno','village', 'profession','nid','land', 'house_type','yearly_tax','budget_year','remark'];	
	
	public function usefulllinks() {
		return $this->belongsTo(Usefulllink::class, 'usefulllink_id','id');
    }
	
	public function secretaries() {
		return $this->belongsTo(Secretary::class, 'secretary_id','id');
    }
}
