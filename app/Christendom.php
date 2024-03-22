<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Christendom extends Model
{
    protected $fillable = ['date','title','body','slug','category','keywords'];
}
