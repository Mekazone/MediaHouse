<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChristendomComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
