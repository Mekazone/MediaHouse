<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiocesanNotifsComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
