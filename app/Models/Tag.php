<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tags";
    protected $fillable = [
        'title'
    ];
    public function ads(){
        return $this->belongsToMany('App\Models\Ad','ad_tag');
    }
}
