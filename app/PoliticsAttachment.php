<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoliticsAttachment extends Model
{
    protected $fillable = ['name','filePosition','slug','postId','fileCategoryId','caption'];
}
