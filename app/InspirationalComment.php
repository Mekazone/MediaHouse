<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InspirationalComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
