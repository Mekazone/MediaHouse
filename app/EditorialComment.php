<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditorialComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
