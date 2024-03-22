<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceAttachment extends Model
{
    protected $fillable = ['name','fileCategoryId','filePosition','slug','caption'];
}
