<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SundayTonicComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
