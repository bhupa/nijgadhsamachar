<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'category_id';

    protected $fillable = ['category_name'];

    //creater
    public function user(){
    	return $this->belongsTo('App\User','create_by','user_id');
    }

    
}
