<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SetInterval extends Model
{
    protected $table = 'carousel_interval';
    protected $connection = 'mysql'; 

	    protected $fillable = [
		'carousel',
		'data_interval',
		'updated_at',
		'created_at',
	]; 
}
