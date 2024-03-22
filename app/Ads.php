<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $fillable = ['start_date','end_date','title','image_name','image_dimension','url'];
}
