<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UsersDatas;
use App\Models\Movies;
use App\Models\Scores;


class Users extends Model{
    
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

      /**
     * Function to get UserDatas
     */
    public function UsersDatas()
    {
        return $this->hasOne(UsersDatas::class,'users_id');
    }

    /**
     * Function to get Users of favorites
    */
    public function Favorites(){
        
        return $this->belongsToMany(Movies::class, 'favorites', 'movies_id','users_id');
    }

  
    /**
     * Function to get Scores of Movies
    */
    public function Scores(){

        return $this->hasMany(Scores::class,'users_id');
    }
}
