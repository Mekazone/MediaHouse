<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsISeeItComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
