<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactAttachment extends Model
{
    protected $fillable = ['name','fileCategoryId','filePosition','slug','caption'];
}
