<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';

    protected $primaryKey = 'comment_id';

    public function user(){
      return $this->belongsTo('App\User','user_id','user_id');
    }

    public function news(){
      return $this->belongsTo('App\News','news_id','news_id');
    }
}
