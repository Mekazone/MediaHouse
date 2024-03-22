<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SportsProfileComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
