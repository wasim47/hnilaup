<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsEvent extends Model
{

	protected $fillable = ['cat_id','name', 'url','details', 'image', 'meta_details','keywords','sequence', 'status'];	
}
