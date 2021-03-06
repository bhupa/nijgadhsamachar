<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
     protected $table = 'users';
     protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname','address','contact', 'email','gender','user_type', 'password','remember_token','by_admin','image'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function isAdmin(){
        return $this->user_type == "Admin";
    }

    public function isRepoter(){
        return $this->user_type == "Reporter";
    }

    // public function news(){
    //     return $this->hasMany('App\News','user_id','user_id');
    // }

    public function getImage(){
        return asset('public/images/'.$this->image);
    }
    public function getUser_type(){
         return $this->user_type ;
    }
     public function catetgory(){
        return $this->hasMany('App\category','user_id','user_id');
    }
}
