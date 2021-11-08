<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fixbanner extends Model
{

	protected $fillable = ['name', 'url', 'image', 'meta_details','keywords','sequence', 'status'];	
}
