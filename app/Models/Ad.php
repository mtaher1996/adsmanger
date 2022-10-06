<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = "ads";
    protected $fillable = [
        'title','description','user_id','category_id','start_at','isFree'
    ];

    public function category(){
        return $this->belongsTo("App\Models\Category");
    }
    public function user(){
        return $this->belongsTo("App\Models\User");
    }
    
    public function tags(){
        return $this->belongsToMany('App\Models\Tag','ad_tag');
    }

    
}
