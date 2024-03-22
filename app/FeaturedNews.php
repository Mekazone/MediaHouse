<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeaturedNews extends Model
{
    protected $fillable = ['postId','title','category','photo','link'];
}
