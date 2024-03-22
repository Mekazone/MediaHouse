<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutAttachment extends Model
{
    protected $fillable = ['name','fileCategoryId','filePosition','slug','caption'];
}
