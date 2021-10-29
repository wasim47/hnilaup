<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnionInformation extends Model
{

	protected $fillable = ['name', 'secretary_id','spouse_name','holding_no','village', 'profession','nid','land', 'house_type','yearly_tax','budget_year','remark'];	
}
