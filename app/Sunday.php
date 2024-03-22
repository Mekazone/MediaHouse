<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sunday extends Model
{
    protected $fillable = ['date','title','body','slug','category','keywords'];
}
