<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParishesNewsComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
