<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	protected $table = 'news';
     protected $primaryKey = 'news_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body','image','create_by', 'by_admin','edit_by','category_type'];

public function user()
{
	return $this->belongsTo('App\User','create_by','user_id');
}
public function editor()
{
	return $this->belongsTo('App\User','edit_by','user_id');
}
    public function getImage(){
        return asset('news/'.$this->image);
    }

		function comments(){
			return $this->hasMany('App\Comment','news_id','news_id')->orderBy('comment.created_at','desc');
		}

    public function category()
    {
        return $this->belongsTo('App\category','category_type','category_id');
    }
}
