<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YoungPeopleComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
