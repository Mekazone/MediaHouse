<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SportsComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
