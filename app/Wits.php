<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wits extends Model
{
    protected $fillable = ['date','title','body','slug','category','keywords'];
}
