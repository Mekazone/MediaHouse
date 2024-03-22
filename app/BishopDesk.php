<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BishopDesk extends Model
{
    protected $fillable = ['date','title','body','slug','category','keywords'];
}
