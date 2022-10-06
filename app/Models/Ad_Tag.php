<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad_Tag extends Model
{
    protected $table = "ad_tag";
    protected $fillable = [
        'ad_id','tag_id'
    ];    
}
