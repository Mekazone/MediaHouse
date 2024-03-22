<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OdogwuComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
