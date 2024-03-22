<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosad extends Model
{
    protected $fillable = ['date','title','body','slug','category','keywords'];
}
