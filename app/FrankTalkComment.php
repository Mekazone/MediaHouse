<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FrankTalkComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
