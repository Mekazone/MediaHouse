<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WitsComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
