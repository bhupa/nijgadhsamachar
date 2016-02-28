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
	return $this->belongsTo('App\User','user_id','create_by');
}
public function editor()
{
	return $this->belongsTo('App\User','user_id','edit_by');
}


    public function getImage(){
        return asset('public/news/'.$this->image);
    }
    public function category()
    {
        return $this->belongsTo('App\category','category_type','category_id');
    }
}
