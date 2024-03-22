<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpinionComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
