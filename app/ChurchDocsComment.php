<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChurchDocsComment extends Model
{
    protected $fillable = ['postId','date','name','comment','status'];
}
