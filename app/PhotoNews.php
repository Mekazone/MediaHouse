<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoNews extends Model
{
    protected $fillable = ['date','name','caption','albumId'];
}
