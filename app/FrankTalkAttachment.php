<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FrankTalkAttachment extends Model
{
    protected $fillable = ['name','filePosition','slug','postId','fileCategoryId','caption'];
}
