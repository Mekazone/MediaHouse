<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
