<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BishopsDeskComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
