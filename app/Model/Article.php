<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title','body','user_id','render'];
    
    public function categories()
    {
        return $this->belongsToMany('App\Model\Category','arts_catgs','article_id','category_id');
    }
}
