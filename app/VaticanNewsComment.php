<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VaticanNewsComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
