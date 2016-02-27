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

    public function User(){
    	return $this->hasMany('App\User','category_id','category_id');
    }

    
}
