<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertorialComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
